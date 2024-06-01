<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\ShippingCharge;

class ShippingController extends Controller
{
    public function shippingCharges()
    {
        Session::put('page', 'shipping');

        $shippingCharges = ShippingCharge::get()->toArray();

        return view('admin.shipping.shipping_charges')->with(compact('shippingCharges'));
    }

    public function editShippingCharges($id, Request $request)
    {
        Session::put('page', 'shipping');

        if ($request->isMethod('post')) {
            $data = $request->all();

            ShippingCharge::where('id', $id)->update([
                '0_500g'      => $data['0_500g'],
                '501g_1000g'  => $data['501g_1000g'],
                '1001_2000g'  => $data['1001_2000g'],
                '2001g_5000g' => $data['2001g_5000g'],
                'above_5000g' => $data['above_5000g'],
            ]);

            $message = 'Shipping Charges updated successfully!';

            return redirect()->back()->with('success_message', $message);
        }

        $shippingDetails = ShippingCharge::where('id', $id)->first();
        $title = 'Edit Shipping Charges';

        return view('admin.shipping.edit_shipping_charges')->with(compact('shippingDetails', 'title'));
    }
}
