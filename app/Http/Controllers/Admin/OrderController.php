<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItemStatus;

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
            $orders = Order::with([
                'orders_products' => function ($query) use ($vendor_id) {
                    $query->where('vendor_id', $vendor_id);
                }
            ])->orderBy('id', 'Desc')->get();
        } else {
            $orders = Order::with('orders_products')->orderBy('id', 'Desc')->get();
        }

        return view('admin.orders.orders')->with(compact('orders'));
    }

    public function orderDetails($id)
    {
        Session::put('page', 'orders');

        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;

        if ($adminType == 'vendor') {
            $orderDetails = Order::with([
                'orders_products' => function ($query) use ($vendor_id) {
                    $query->where('vendor_id', $vendor_id);
                }
            ])->where('id', $id)->first();
        } else {
            $orderDetails = Order::with('orders_products')->where('id', $id)->first();
        }

        $userDetails = User::where('id', $orderDetails['user_id'])->first();
        $orderItemStatuses = OrderItemStatus::where([
            'status' => 1,
            'name' => 'In Progress'
        ])->get();
        $total_items = 0;

        foreach ($orderDetails['orders_products'] as $product) {
            $total_items = $total_items + $product['product_qty'];
        }

        if ($orderDetails['coupon_amount'] > 0) {
            $item_discount = round($orderDetails['coupon_amount'] / $total_items, 2);
        } else {
            $item_discount = 0;
        }

        return view('admin.orders.order_details')->with(compact('orderDetails', 'userDetails', 'orderItemStatuses', 'item_discount'));
    }
}
