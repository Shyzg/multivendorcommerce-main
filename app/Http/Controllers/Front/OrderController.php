<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orders($id = null)
    {
        if (is_null($id)) {
            $orders = Order::with(['orders_products.product'])
                ->where('user_id', Auth::id())
                ->orderBy('id', 'desc')
                ->get();

            return view('front.orders.orders', compact('orders'));
        }

        $orderDetails = Order::with(['orders_products.product'])
            ->findOrFail($id);

        return view('front.orders.order_details', compact('orderDetails'));
    }
}
