<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\Vendor;
use App\Models\Admin;

class VendorController extends Controller
{
    public function loginRegister()
    {
        return view('front.vendors.login_register');
    }

    public function vendorRegister(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'name'          => 'required',
                'email'         => 'required|email|unique:admins|unique:vendors',
                'mobile'        => 'required|min:10|numeric|unique:admins|unique:vendors',
                'accept'        => 'required'
            ];
            $customMessages = [
                'name.required'             => 'Name is required',
                'email.required'            => 'Email is required',
                'email.unique'              => 'Email alreay exists',
                'mobile.required'           => 'Mobile is required',
                'mobile.unique'             => 'Mobile alreay exists',
                'accept.required'           => 'Please accept Terms & Conditions',
            ];
            $validator = Validator::make($data, $rules, $customMessages);

            if ($validator->fails()) {
                return \Illuminate\Support\Facades\Redirect::back()->withErrors($validator);
            }

            DB::beginTransaction();

            $vendor = new Vendor;
            $vendor->name   = $data['name'];
            $vendor->mobile = $data['mobile'];
            $vendor->email  = $data['email'];
            $vendor->status = 0;
            date_default_timezone_set('Asia/Jakarta');
            $vendor->created_at = date('Y-m-d H:i:s');
            $vendor->updated_at = date('Y-m-d H:i:s');
            $vendor->save();
            $vendor_id = DB::getPdo()->lastInsertId();

            $admin = new Admin;
            $admin->type      = 'vendor';
            $admin->vendor_id = $vendor_id;
            $admin->name      = $data['name'];
            $admin->mobile    = $data['mobile'];
            $admin->email     = $data['email'];
            $admin->password  = bcrypt($data['password']);
            $admin->status    = 0;
            date_default_timezone_set('Africa/Cairo');
            $admin->created_at = date('Y-m-d H:i:s');
            $admin->updated_at = date('Y-m-d H:i:s');
            $admin->save();

            DB::commit();

            $message = 'Thanks for registering as Vendor.';

            return redirect()->back()->with('success_message', $message);
        }
    }
}
