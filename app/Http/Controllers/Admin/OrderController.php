<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItemStatus;
use App\Models\OrdersProduct;
use Illuminate\Http\Client\Request;

class OrderController extends Controller
{
    // Menampilkan halaman coupon di dashboard admin pada views admin/orders/orders.blade.php
    public function orders()
    {
        // Menggunakan session untuk sebagai penanda halaman yang sedang digunakan pada sidebar
        Session::put('page', 'orders');

        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;

        if ($adminType == 'vendor') {
            // Mendapatkan semua order yang memiliki produk yang terkait dengan vendor tertentu
            $orders = Order::whereHas('orders_products', function ($query) use ($vendor_id) {
                // Memfilter orders_products berdasarkan vendor_id
                $query->where('vendor_id', $vendor_id);
            })->with([
                'orders_products' => function ($query) use ($vendor_id) {
                    // Memuat relasi produk terkait untuk setiap orders_product
                    $query->where('vendor_id', $vendor_id)->with('product');
                }
            ])->orderBy('id', 'desc')->get();
        } else {
            // Kalau tipe adminnya bukan vendor, akan menampilkan keselurannya
            $orders = Order::with('orders_products.product')->orderBy('id', 'desc')->get();
        }

        return view('admin.orders.orders', compact('orders'));
    }

    public function orderDetails($id)
    {
        Session::put('page', 'orders');

        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;
        $order = Order::with('orders_products.product')->findOrFail($id);

        $orderDetails = Order::with([
            'orders_products' => function ($query) use ($vendor_id) {
                $query->where('vendor_id', $vendor_id);
            }
        ])->when($adminType != 'vendor', function ($query) {
            $query->with('orders_products.product');
        })->findOrFail($id);

        $userDetails = User::findOrFail($orderDetails->user_id);
        $orderItemStatuses = OrderItemStatus::where('status', 1)->get();
        $total_items = $orderDetails->orders_products->sum('product_qty');

        $item_discount = $orderDetails->coupon_amount > 0 ? round($orderDetails->coupon_amount / $total_items, 2) : 0;

        return view('admin.orders.order_details')->with(compact('order', 'orderDetails', 'userDetails', 'orderItemStatuses', 'item_discount', 'vendor_id'));
    }

    public function updateOrderItemStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // Validasi status
            $statusExists = OrderItemStatus::where('name', $data['order_item_status'])->exists(); // Memeriksa apakah status ada di tabel order_item_statuses
            if (!$statusExists) {
                return redirect()->back()->with('error_message', 'Invalid order item status');
            }

            OrdersProduct::where('id', $data['order_item_id'])->update([
                'item_status' => $data['order_item_status']
            ]); // Memperbarui data item order

            // Ambil order_id
            $orderItem = OrdersProduct::select('order_id')->where('id', $data['order_item_id'])->first(); // Mengambil order_id dari item order

            // Cek jika order item ada
            if (!$orderItem) {
                return redirect()->back()->with('error_message', 'Order item not found');
            }

            $orderDetails = Order::with([
                'orders_products' => function ($query) use ($data) {
                    $query->where('id', $data['order_item_id']);
                }
            ])->where('id', $orderItem->order_id)->first(); // Mengambil detail order dengan order_id yang sesuai

            $message = 'Order Item Status has been updated successfully!'; // Pesan sukses

            return redirect()->back()->with('success_message', $message); // Redirect kembali dengan pesan sukses
        }
    }
}
