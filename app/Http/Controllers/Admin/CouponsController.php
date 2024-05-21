<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;

class CouponsController extends Controller
{
    public function coupons()
    {
        Session::put('page', 'coupons');

        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;

        if ($adminType == 'vendor') {
            $coupons = Coupon::where('vendor_id', $vendor_id)->get()->toArray();
        } else {
            $coupons = Coupon::get()->toArray();
        }

        return view('admin.coupons.coupons')->with(compact('coupons'));
    }

    public function deleteCoupon($id)
    {
        Coupon::where('id', $id)->delete();

        $message = 'Coupon has been deleted successfully!';

        return redirect()->back()->with('success_message', $message);
    }

    public function addEditCoupon(Request $request, $id = null)
    {
        Session::put('page', 'coupons');


        if ($id == '') {
            $title = 'Add Coupon';
            $coupon = new Coupon;
            $selCats   = array();
            $selUsers  = array();
            $message = 'Coupon added successfully!';
        } else {
            $title = 'Edit Coupon';
            $coupon = Coupon::find($id);
            $selCats   = explode(',', $coupon['categories']);
            $selUsers  = explode(',', $coupon['users']);
            $message = 'Coupon updated successfully!';
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'categories'    => 'required',
                'coupon_option' => 'required',
                'coupon_type'   => 'required',
                'amount_type'   => 'required',
                'amount'        => 'required|numeric',
                'expiry_date'   => 'required'
            ];
            $customMessages = [
                'categories.required'    => 'Select Categories',
                'coupon_option.required' => 'Select Coupon Option',
                'coupon_type.required'   => 'Select Coupon Type',
                'amount_type.required'   => 'Select Amount Type',
                'amount.required'        => 'Enter Amount',
                'amount.numeric'         => 'Enter Valid Amount',
                'expiry_date.required'   => 'Enter Expiry Date',
            ];

            $this->validate($request, $rules, $customMessages);

            if (isset($data['categories'])) {
                $categories = implode(',', $data['categories']);
            } else {
                $categories = '';
            }

            if (isset($data['users'])) {
                $users = implode(',', $data['users']);
            } else {
                $users = '';
            }

            if ($data['coupon_option'] == 'Automatic') {
                $coupon_code = \Illuminate\Support\Str::random(8);
            } else {
                $coupon_code = $data['coupon_code'];
            }

            $adminType = Auth::guard('admin')->user()->type;
            if ($adminType == 'vendor') {
                $coupon->vendor_id = Auth::guard('admin')->user()->vendor_id;
            } else {
                $coupon->vendor_id = 0;
            }

            $coupon->coupon_option = $data['coupon_option'];
            $coupon->coupon_code   = $coupon_code;
            $coupon->categories    = $categories;
            $coupon->users         = $users;
            $coupon->coupon_type   = $data['coupon_type'];
            $coupon->amount_type   = $data['amount_type'];
            $coupon->amount        = $data['amount'];
            $coupon->expiry_date   = $data['expiry_date'];
            $coupon->status        = 1;
            $coupon->save();

            return redirect('admin/coupons')->with('success_message', $message);
        }

        $categories = \App\Models\Section::with('categories')->get()->toArray();
        $users = \App\Models\User::select('email')->get();

        return view('admin.coupons.add_edit_coupon')->with(compact('title', 'coupon', 'categories', 'users', 'selCats', 'selUsers'));
    }
}
