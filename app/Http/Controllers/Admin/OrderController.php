<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\OrdersProduct;
use App\Models\OrdersLog;
use App\Models\OrderStatus;
use App\Models\OrderItemStatus;

class OrderController extends Controller
{
    public function orders()
    {
        Session::put('page', 'orders');

        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;

        if ($adminType == 'vendor') {
            $orders = Order::with([
                'orders_products' => function ($query) use ($vendor_id) {
                    $query->where('vendor_id', $vendor_id);
                }
            ])->orderBy('id', 'Desc')->get()->toArray();
        } else {
            $orders = Order::with('orders_products')->orderBy('id', 'Desc')->get()->toArray();
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
            ])->where('id', $id)->first()->toArray();
        } else {
            $orderDetails = Order::with('orders_products')->where('id', $id)->first()->toArray();
        }

        $userDetails = User::where('id', $orderDetails['user_id'])->first()->toArray();
        $orderStatuses = OrderStatus::where('status', 1)->get()->toArray();
        $orderItemStatuses = OrderItemStatus::where(
            [
                'status' => 1,
                'name' => 'In Progress'
            ]
        )->get()->toArray();
        $orderLog = OrdersLog::with('orders_products')->where('order_id', $id)->orderBy('id', 'Desc')->get()->toArray();
        $total_items = 0;

        foreach ($orderDetails['orders_products'] as $product) {
            $total_items = $total_items + $product['product_qty'];
        }

        if ($orderDetails['coupon_amount'] > 0) {
            $item_discount = round($orderDetails['coupon_amount'] / $total_items, 2);
        } else {
            $item_discount = 0;
        }

        return view('admin.orders.order_details')->with(compact('orderDetails', 'userDetails', 'orderStatuses', 'orderItemStatuses', 'orderLog', 'item_discount'));
    }

    public function updateOrderStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            if (empty($data['courier_name']) && empty($data['tracking_number']) && $data['order_status'] == 'Shipped') {
                $getResults = Order::pushOrder($data['order_id']);

                if (!isset($getResults['status']) || (isset($getResults['status']) && $getResults['status'] == false)) {
                    Session::put('error_message', $getResults['message']);

                    return redirect()->back();
                }
            }

            Order::where('id', $data['order_id'])->update(['order_status' => $data['order_status']]);

            if (!empty($data['courier_name']) && !empty($data['tracking_number'])) {
                Order::where('id', $data['order_id'])->update([
                    'courier_name'    => $data['courier_name'],
                    'tracking_number' => $data['tracking_number']
                ]);
            }

            $log = new OrdersLog;
            $log->order_id     = $data['order_id'];
            $log->order_status = $data['order_status'];
            $log->save();
            $message = 'Order Status has been updated successfully!';

            return redirect()->back()->with('success_message', $message);
        }
    }

    public function updateOrderItemStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            OrdersProduct::where('id', $data['order_item_id'])->update(['item_status' => $data['order_item_status']]);

            if (!empty($data['item_courier_name']) && !empty($data['item_tracking_number'])) {
                OrdersProduct::where('id', $data['order_item_id'])->update([
                    'courier_name'    => $data['item_courier_name'],
                    'tracking_number' => $data['item_tracking_number']
                ]);
            }

            $getOrderId = OrdersProduct::select('order_id')->where('id', $data['order_item_id'])->first()->toArray();
            $log = new OrdersLog;
            $log->order_id      = $getOrderId['order_id'];
            $log->order_item_id = $data['order_item_id'];
            $log->order_status  = $data['order_item_status'];
            $log->save();

            $message = 'Order Item Status has been updated successfully!';

            return redirect()->back()->with('success_message', $message);
        }
    }

    public function viewOrderInvoice($order_id)
    {
        $orderDetails = Order::with('orders_products')->where('id', $order_id)->first()->toArray();
        $userDetails = User::where('id', $orderDetails['user_id'])->first()->toArray();

        return view('admin.orders.order_invoice')->with(compact('orderDetails', 'userDetails'));
    }
}
