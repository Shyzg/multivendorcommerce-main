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
        // URL sekarang
        $url = Route::current()->uri();
        // Hitung jumlah kategori dengan URL tersebut
        $categoryCount = Category::where('url', $url)->count();

        if ($categoryCount > 0) {
            // Ambil detail kategori berdasarkan URL
            $categoryDetails = Category::categoryDetails($url);
            // Ambil produk berdasarkan category_id
            $categoryProducts = Product::whereIn('category_id', $categoryDetails['catIds'])
                ->paginate(30);

            return view('front.products.listing', compact('categoryDetails', 'categoryProducts', 'url'));
        } else {
            abort(404);
        }
    }

    public function vendorListing($vendorid)
    {
        // Mengambil detail toko vendor berdasarkan ID vendor
        $getVendorShop = Vendor::getVendorShop($vendorid);
        // Mengambil produk vendor dan mem-paginate hasilnya, 30 per halaman
        $vendorProducts = Product::where('vendor_id', $vendorid)->paginate(30);

        return view('front.products.vendor_listing', compact('getVendorShop', 'vendorProducts'));
    }

    public function detail($id)
    {
        $productDetails = Product::with([
            // Mengambil produk dengan relasi section, category, attributes (stok > 0), images, dan vendor
            'section', 'category', 'attributes' => fn ($query) => $query->where('stock', '>', 0),
            'images', 'vendor'
        ])->find($id);
        // Menghitung total stok produk
        $totalStock = ProductsAttribute::where('product_id', $id)->sum('stock');
        // Mendapatkan detail kategori berdasarkan URL kategori produk
        $categoryDetails = Category::categoryDetails($productDetails['category']['url'] ?? null);
        // Mendapatkan session_id atau membuat yang baru jika belum ada
        $session_id = Session::get('session_id', Session::getId());
        // Menyimpan session_id di session
        Session::put('session_id', $session_id);

        return view('front.products.detail', compact('productDetails', 'categoryDetails', 'totalStock'));
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

            // Menghapis sesi kupon sebelumnya
            Session::forget(['couponAmount', 'couponCode']);

            // Memastikan kuantitas minimal 1
            $data['quantity'] = max($data['quantity'], 1);

            // Cek stok produk
            if (ProductsAttribute::getProductStock($data['product_id']) < $data['quantity']) {
                return redirect()->back()->with('error_message', 'Kuantitas yang dibutuhkan tidak tersedia');
            }

            // Ambil session_id atau bikin baru kalau belum ada
            $session_id = Session::get('session_id', Session::getId());
            Session::put('session_id', $session_id);

            // Menentukan user_id lalu hitung produk di keranjang
            $user_id = Auth::id() ?? 0;
            $countProducts = Cart::where([
                'user_id'    => $user_id,
                'session_id' => $session_id,
                'product_id' => $data['product_id']
            ])->count();

            // Tambahkan atau update kuantitas produk
            if ($countProducts > 0) {
                Cart::where([
                    'user_id'    => $user_id,
                    'product_id' => $data['product_id'],
                    'session_id' => $session_id,
                ])->increment('quantity', $data['quantity']);
            } else {
                Cart::create([
                    'user_id'    => $user_id,
                    'product_id' => $data['product_id'],
                    'session_id' => $session_id,
                    'quantity'   => $data['quantity']
                ]);
            }

            return redirect()->back()->with('success_message', 'Produk ini telah dimasukkan kedalam keranjang <a href="/cart" style="text-decoration: underline !important">Lihat Keranjang</a>');
        }
    }

    public function cartUpdate(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            // Menghapus sesi kupon sebelumnya
            Session::forget(['couponAmount', 'couponCode']);

            // Ambil detail keranjang
            $cartDetails = Cart::find($data['cartid']);
            // Ambil stok yang tersedia dari produk yang terkait sama item dalam keranjang
            $availableStock = ProductsAttribute::select('stock')
                ->where('product_id', $cartDetails->product_id)
                ->first();

            // Kalau jumlah yang diminta melebihi stok yang tersedia
            if ($data['qty'] > $availableStock->stock) {
                $getCartItems = Cart::getCartItems();

                // Kembalikan respons JSON dengan status false, pesan error, dan tampilan item-item keranjang yang diperbarui
                return response()->json([
                    'status'  => false,
                    'message' => 'Stok produk tidak tersedia',
                    'view'    => (string) View::make('front.products.cart_items')->with(compact('getCartItems'))
                ]);
            }

            // Perbarui kuantitas item keranjang yang dipilih
            Cart::where('id', $data['cartid'])->update([
                'quantity' => $data['qty']
            ]);

            $getCartItems = Cart::getCartItems();

            Session::forget(['couponAmount', 'couponCode']);

            return response()->json([
                'status' => true,
                'view'   => (string) View::make('front.products.cart_items')->with(compact('getCartItems'))
            ]);
        }
    }

    public function cartDelete(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            Session::forget(['couponAmount', 'couponCode']);

            Cart::where('id', $data['cartid'])->delete();

            $getCartItems = Cart::getCartItems();

            return response()->json([
                'view'   => (string) View::make('front.products.cart_items')->with(compact('getCartItems'))
            ]);
        }
    }

    public function applyCoupon(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            Session::forget(['couponAmount', 'couponCode']);

            // Ambil item-item keranjang
            $getCartItems = Cart::getCartItems();
            // Hitung jumlah kupon dengan kode yang diberikan
            $couponCount = Coupon::where('coupon_code', $data['code'])->count();

            // Kalau gaada ada kupon dengan kode yang diberikan
            if ($couponCount == 0) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Masukkan kode kupon yang benar',
                    'view'    => (string) View::make('front.products.cart_items')->with(compact('getCartItems'))
                ]);
            } else {
                $couponDetails = Coupon::where('coupon_code', $data['code'])->first();
                $expiry_date  = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');

                if ($expiry_date < $current_date) {
                    $message = 'Kode kupon ini tidak dapat digunakan karena telah melebihi tanggal yang telah ditentukan';
                }

                // Jika tipe kupon adalah "Sekali Pakai"
                if ($couponDetails->coupon_type == 'Sekali Pakai') {
                    // Hitung jumlah pesanan yang menggunakan kupon ini
                    $couponCount = Order::where([
                        'user_id'     => Auth::user()->id,
                        'coupon_code' => $data['code']
                    ])->count();

                    // Jika kupon telah digunakan sebelumnya
                    if ($couponCount >= 1) {
                        $message = 'Kupon ini telah digunakan';
                    }
                }

                // Dapatkan kategori yang diperbolehkan untuk kupon
                $catArr = explode(',', $couponDetails->categories);
                $total_amount = 0;

                // Iterasi melalui item keranjang belanja
                foreach ($getCartItems as $key => $item) {
                    // Jika produk tidak termasuk dalam kategori yang diperbolehkan untuk kupon
                    if (!in_array($item['product']['category_id'], $catArr)) {
                        $message = 'Kode kupon ini hanya dapat digunakan pada kategori yang telah ditentukan';
                    }

                    // Hitung total jumlah yang memenuhi syarat untuk penggunaan kupon
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

            // if ($data['payment_gateway'] == 'Midtrans') {
            //     $order_status   = 'Baru';
            // } else {
            //     $order_status   = 'Pending';
            // }

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
            $order->payment_gateway  = $data['payment_gateway'];
            $order->order_status     = "Menunggu Pembayaran";
            $order->grand_total      = $data['grand_total'];
            // Menyimpan data ke tabel orders
            $order->save();
            // Digunakan untuk mendapatkan id auto-increment dari tabel orders yang barusan disimpan yang ada didalam variable $order_id
            $order_id = DB::getPdo()->lastInsertId();

            foreach ($getCartItems as $item) {
                $cartItem                  = new OrdersProduct;
                $cartItem->user_id         = Auth::user()->id;
                $cartItem->order_id        = $order_id;
                $getProductDetails         = Product::select('admin_id', 'vendor_id')->where('id', $item['product_id'])->first();
                $cartItem->admin_id        = $getProductDetails['admin_id'];
                $cartItem->vendor_id       = $getProductDetails['vendor_id'];
                $cartItem->product_id      = $item['product_id'];
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

            if ($data['payment_gateway'] == 'Midtrans') {
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

            if ($data['payment_gateway'] == 'Midtrans') {
                return view('front.orders.show', compact('order', 'snapToken'));
            }
        }

        $countries = Country::orderBy('name', 'asc')->get();
        $cities = City::orderBy('name', 'asc')->get();
        $provinces = Province::orderBy('name', 'asc')->get();

        return view('front.products.checkout')->with(compact('deliveryAddresses', 'countries', 'cities', 'provinces', 'getCartItems', 'total_price'));
    }
}
