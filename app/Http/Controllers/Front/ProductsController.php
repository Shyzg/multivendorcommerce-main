<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\DeliveryAddress;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\User;
use App\Models\Country;
use App\Models\OrdersProduct;
use App\Models\City;
use App\Models\Province;
use App\Services\Midtrans\CreateSnapTokenService;

class ProductsController extends Controller
{
    public function listing(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $url          = $data['url'];
            $categoryCount = Category::where(['url' => $url])->count();

            if ($categoryCount > 0) {
                $categoryDetails = Category::categoryDetails($url);
                $categoryProducts = Product::whereIn('category_id', $categoryDetails['catIds']);
                $productIds = array();

                if (isset($data['price']) && !empty($data['price'])) {
                    foreach ($data['price'] as $key => $price) {
                        $priceArr = explode('-', $price);
                        if (isset($priceArr[0]) && isset($priceArr[1])) {
                            $productIds[] = Product::select('id')->whereBetween('product_price', [$priceArr[0], $priceArr[1]])->pluck('id');
                        }
                    }

                    $productIds = array_unique(Arr::flatten($productIds));
                    $categoryProducts->whereIn('products.id', $productIds);
                }

                $categoryProducts = $categoryProducts->paginate(30);

                return view('front.products.ajax_products_listing')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }
        } else {
            $url = Route::getFacadeRoot()->current()->uri();
            $categoryCount = Category::where(['url' => $url])->count();

            if ($categoryCount > 0) {
                $categoryDetails = Category::categoryDetails($url);
                $categoryProducts = Product::whereIn('category_id', $categoryDetails['catIds']);
                $categoryProducts = $categoryProducts->paginate(30);

                return view('front.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }
        }
    }

    public function vendorListing($vendorid)
    {
        $getVendorShop = Vendor::getVendorShop($vendorid);
        $vendorProducts = Product::where('vendor_id', $vendorid);
        $vendorProducts = $vendorProducts->paginate(30);

        return view('front.products.vendor_listing')->with(compact('getVendorShop', 'vendorProducts'));
    }

    public function detail($id)
    {
        $productDetails = Product::with([
            'section', 'category', 'attributes' => function ($query) {
                $query->where('stock', '>', 0);
            }, 'images', 'vendor'
        ])->find($id);
        $categoryDetails = Category::categoryDetails($productDetails['category']['url'] ?? null);

        if (empty(Session::get('session_id'))) {
            $session_id = md5(uniqid(rand(), true));
        } else {
            $session_id = Session::get('session_id');
        }

        Session::put('session_id', $session_id);

        $totalStock = ProductsAttribute::where('product_id', $id)->sum('stock');

        return view('front.products.detail')->with(compact('productDetails', 'categoryDetails', 'totalStock'));
    }

    public function cart()
    {
        $getCartItems = Cart::getCartItems();

        return view('front.products.cart')->with(compact('getCartItems'));
    }

    public function cartAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            Session::forget('couponAmount');
            Session::forget('couponCode');

            if ($data['quantity'] <= 0) {
                $data['quantity'] = 1;
            }

            $getProductStock = ProductsAttribute::getProductStock($data['product_id']);

            if ($getProductStock < $data['quantity']) {
                return redirect()->back()->with('error_message', 'Kuantitas yang dibutuhkan tidak tersedia');
            }

            $session_id = Session::get('session_id');

            if (empty($session_id)) {
                $session_id = Session::getId();

                Session::put('session_id', $session_id);
            }

            if (Auth::check()) {
                $user_id = Auth::user()->id;
                $countProducts = Cart::where([
                    'user_id'    => $user_id,
                    'product_id' => $data['product_id']
                ])->count();
            } else {
                $user_id = 0;
                $countProducts = Cart::where([
                    'session_id' => $session_id,
                    'product_id' => $data['product_id']
                ])->count();
            }

            if ($countProducts > 0) {
                Cart::where([
                    'session_id' => $session_id,
                    'user_id'    => $user_id ?? 0,
                    'product_id' => $data['product_id']
                ])->increment('quantity', $data['quantity']);
            } else {
                $item = new Cart;
                $item->session_id = $session_id;
                $item->user_id    = $user_id;
                $item->product_id = $data['product_id'];
                $item->quantity   = $data['quantity'];
                $item->save();
            }

            return redirect()->back()->with('success_message', 'Produk ini telah dimasukkan kedalam keranjang <a href="/cart" style="text-decoration: underline !important">Lihat Keranjang</a>');
        }
    }

    public function cartUpdate(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            Session::forget('couponAmount');
            Session::forget('couponCode');

            $cartDetails = Cart::find($data['cartid']);
            $availableStock = ProductsAttribute::select('stock')->where([
                'product_id' => $cartDetails['product_id']
            ])->first();

            if ($data['qty'] > $availableStock['stock']) {
                $getCartItems = Cart::getCartItems();

                return response()->json([
                    'status'     => false,
                    'message'    => 'Stok produk tidak tersedia',
                    'view'       => (string) View::make('front.products.cart_items')->with(compact('getCartItems'))
                ]);
            }

            Cart::where('id', $data['cartid'])->update([
                'quantity' => $data['qty']
            ]);

            $getCartItems = Cart::getCartItems();
            $totalCartItems = totalCartItems();

            Session::forget('couponAmount');
            Session::forget('couponCode');

            return response()->json([
                'status'         => true,
                'totalCartItems' => $totalCartItems,
                'view'           => (string) View::make('front.products.cart_items')->with(compact('getCartItems'))
            ]);
        }
    }

    public function cartDelete(Request $request)
    {
        if ($request->ajax()) {
            Session::forget('couponAmount');
            Session::forget('couponCode');

            $data = $request->all();

            Cart::where('id', $data['cartid'])->delete();

            $getCartItems = Cart::getCartItems();
            $totalCartItems = totalCartItems();

            return response()->json([
                'totalCartItems' => $totalCartItems,
                'view'   => (string) View::make('front.products.cart_items')->with(compact('getCartItems'))
            ]);
        }
    }

    public function applyCoupon(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            Session::forget('couponAmount');
            Session::forget('couponCode');

            $getCartItems = Cart::getCartItems();
            $totalCartItems = totalCartItems();
            $couponCount = Coupon::where('coupon_code', $data['code'])->count();

            if ($couponCount == 0) {
                return response()->json([
                    'status'         => false,
                    'totalCartItems' => $totalCartItems,
                    'message'        => 'Masukkan kode kupon yang benar',
                    'view'           => (string) View::make('front.products.cart_items')->with(compact('getCartItems'))
                ]);
            } else {
                $couponDetails = Coupon::where('coupon_code', $data['code'])->first();
                $expiry_date  = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');

                if ($expiry_date < $current_date) {
                    $message = 'Kode kupon ini tidak dapat digunakan karena telah melebihi tanggal yang telah ditentukan';
                }

                if ($couponDetails->coupon_type == 'Sekali Pakai') {
                    $couponCount = Order::where([
                        'coupon_code' => $data['code'],
                        'user_id'     => Auth::user()->id
                    ])->count();

                    if ($couponCount >= 1) {
                        $message = 'Kupon ini telah digunakan';
                    }
                }

                $catArr = explode(',', $couponDetails->categories);
                $total_amount = 0;

                foreach ($getCartItems as $key => $item) {
                    // Kalau didalam array tidak memiliki customer yang telah ditentukan
                    if (!in_array($item['product']['category_id'], $catArr)) {
                        $message = 'Kode kupon ini hanya dapat digunakan pada kategori yang telah ditentukan';
                    }

                    $prodPrice = Product::getDiscountAttributePrice($item['product_id']);
                    $total_amount = $total_amount + ($prodPrice['final_price'] * $item['quantity']);
                }

                if (isset($couponDetails->users) && !empty($couponDetails->users)) {
                    $usersArr = explode(',', $couponDetails->users);
                    if (count($usersArr)) {
                        foreach ($usersArr as $key => $user) {
                            $getUserId = User::select('id')->where('email', $user)->first();
                            // Memasukkan customer yang telah ditentukan dalam satu array
                            $usersId[] = $getUserId['id'];
                        }
                        foreach ($getCartItems as $item) {
                            // Kalau didalam array tidak memiliki customer yang telah ditentukan
                            if (!in_array($item['user_id'], $usersId)) {
                                $message = 'Kode kupon ini hanya dapat digunakan pada customer yang telah ditentukan';
                            }
                        }
                    }
                }

                if (isset($message)) {
                    return response()->json([
                        'status'         => false,
                        'totalCartItems' => $totalCartItems,
                        'message'        => $message,
                        'view'           => (string) View::make('front.products.cart_items')->with(compact('getCartItems'))
                    ]);
                } else {
                    if ($couponDetails->amount_type == 'Tetap') {
                        $couponAmount = $couponDetails->amount;
                    } else {
                        $couponAmount = $total_amount * ($couponDetails->amount / 100);
                    }

                    $grand_total = $total_amount - $couponAmount;

                    Session::put('couponAmount', $couponAmount);
                    Session::put('couponCode', $data['code']);

                    $message = 'Kode kupon ini berhasil digunakan';

                    return response()->json([
                        'status'         => true,
                        'totalCartItems' => $totalCartItems,
                        'couponAmount'   => $couponAmount,
                        'grand_total'    => $grand_total,
                        'message'        => $message,
                        'view'           => (string) View::make('front.products.cart_items')->with(compact('getCartItems'))
                    ]);
                }
            }
        }
    }

    public function checkout(Request $request)
    {
        $countries = Country::orderBy('name', 'asc')->get();
        $cities = City::orderBy('name', 'asc')->get();
        $provinces = Province::orderBy('name', 'asc')->get();
        $getCartItems = Cart::getCartItems();

        if (count($getCartItems) == 0) {
            $message = 'Keranjang belanjaan kosong, tambahkan produk kedalam keranjang untuk melanjutkan pemesanan';

            return redirect('cart')->with('error_message', $message);
        }

        $total_price  = 0;
        foreach ($getCartItems as $item) {
            $prodPrice = Product::getDiscountAttributePrice($item['product_id']);
            $total_price = $total_price + ($prodPrice['final_price'] * $item['quantity']);
            $product_weight = $item['product']['product_weight'];
        }

        $deliveryAddresses = DeliveryAddress::deliveryAddresses();

        foreach ($deliveryAddresses as $key => $value) {
            $deliveryAddresses[$key]['shipping_charges'];
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            $getProductStock = ProductsAttribute::getProductStock($item['product_id']);
            if ($getProductStock == 0) {
                $message = $item['product']['product_name'] . ' stok produk ini tidak tersedia atau habis';

                return redirect('/cart')->with('error_message', $message);
            }

            if (empty($data['address_id'])) {
                $message = 'Alamat pengiriman harus dipilih';

                return redirect()->back()->with('error_message', $message);
            }
            if (empty($data['shipping_charges']) || $data['shipping_charges'] == null || $data['grand_total'] == null) {
                $message = 'Metode pengiriman harus dipilih';

                return redirect()->back()->with('error_message', $message);
            }
            if (empty($data['payment_gateway'])) {
                $message = 'Metode pembayaran harus dipilih';

                return redirect()->back()->with('error_message', $message);
            }

            $deliveryAddress = DeliveryAddress::where('id', $data['address_id'])->first();
            $payment_method = 'Prepaid';

            // Untuk memastikan bahwa semua operasi database berikutnya bagian dari proses penyimpanan database yang sama
            DB::beginTransaction();

            $total_price = 0;
            foreach ($getCartItems as $item) {
                $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id']);
                $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item['quantity']);
            }

            $shipping_charges = 0;
            $grand_total = $total_price + $shipping_charges - Session::get('couponAmount');
            // Untuk menyimpan data grand_total kedalam sesi untuk bisa tetap digunakan/tampilkan ke halaman selanjutnya yaitu proses pembayaran midtrans
            Session::put('grand_total', $grand_total);

            $order = new Order;
            $order->user_id          = Auth::user()->id;
            $order->name             = $deliveryAddress['name'];
            $order->address          = $deliveryAddress['address'];
            $order->city             = $deliveryAddress['city'];
            $order->state            = $deliveryAddress['state'];
            $order->country          = $deliveryAddress['country'];
            $order->mobile           = $deliveryAddress['mobile'];
            $order->email            = Auth::user()->email;
            $order->shipping_charges = $data['shipping_charges'];
            $order->coupon_code      = Session::get('couponCode');
            $order->coupon_amount    = Session::get('couponAmount');
            $order->payment_method   = $payment_method;
            $order->payment_gateway  = $data['payment_gateway'];
            $order->grand_total      = $data['grand_total'];
            // Menyimpan data ke tabel orders
            $order->save();
            // Digunakan untuk mendapatkan id auto-increment dari tabel orders yang barusan disimpan yang ada didalam variable $order_id
            $order_id = DB::getPdo()->lastInsertId();

            foreach ($getCartItems as $item) {
                $cartItem                  = new OrdersProduct;
                $cartItem->user_id         = Auth::user()->id;
                $cartItem->order_id        = $order_id;
                $getProductDetails         = Product::select('product_name', 'admin_id', 'vendor_id')->where('id', $item['product_id'])->first();
                $cartItem->admin_id        = $getProductDetails['admin_id'];
                $cartItem->vendor_id       = $getProductDetails['vendor_id'];
                $cartItem->product_id      = $item['product_id'];
                $cartItem->product_name    = $getProductDetails['product_name'];
                $cartItem->item_status     = 'In Progress';
                $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id']);
                $cartItem->product_price   = $getDiscountAttributePrice['final_price'];
                $getProductStock = ProductsAttribute::getProductStock($item['product_id']);
                if ($item['quantity'] > $getProductStock) {
                    $message = $getProductDetails['product_name'] . 'stok produk ini tidak tersedia atau melebihi dalam jumlah kuantitas yang dibutuhkan';

                    return redirect('/cart')->with('error_message', $message);
                }
                $cartItem->product_qty     = $item['quantity'];
                // Menyimpan data ke tabel orders_products
                $cartItem->save();

                // Melakukan perubahan stok produk
                $getProductStock = ProductsAttribute::getProductStock($item['product_id']);
                $newStock = $getProductStock - $item['quantity'];
                ProductsAttribute::where(['product_id' => $item['product_id']])->update(['stock' => $newStock]);
            }

            Session::put('order_id', $order_id);
            // Jika semua operasi penyimpanan kedalam database untuk tabel orders dan orders_products berhasil, DB:commit() digunakan untuk menyimpan semua perubahan yang ada dalam database
            DB::commit();

            if ($data['payment_gateway'] == 'midtrans') {
                DB::beginTransaction();

                $snapToken = $order->snap_token;
                if (is_null($snapToken)) {
                    $midtrans = new CreateSnapTokenService($order);
                    $snapToken = $midtrans->getSnapToken();
                    $order->snap_token = $snapToken;
                }

                $order->save();

                DB::commit();
            }

            $destroyCart = Cart::destroyCartItems();
            $orderDetails = Order::with('orders_products')->where('id', $order_id)->first();

            if ($data['payment_gateway'] == 'midtrans') {
                return view('front.orders.show', compact('order', 'snapToken'));
            }
        }

        return view('front.products.checkout')->with(compact('deliveryAddresses', 'countries', 'cities', 'provinces', 'getCartItems', 'total_price'));
    }
}
