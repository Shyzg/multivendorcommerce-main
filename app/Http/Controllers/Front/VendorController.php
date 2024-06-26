<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Vendor;
use App\Models\Admin;
use App\Models\City;
use App\Models\Country;
use App\Models\Province;

class VendorController extends Controller
{
    public function loginRegister()
    {
        $countries = Country::orderBy('name', 'asc')->get();
        $cities = City::orderBy('name', 'asc')->get();
        $provinces = Province::orderBy('name', 'asc')->get();

        return view('front.vendors.login_register')->with(compact('countries', 'cities', 'provinces'));
    }

    public function vendorRegister(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($request->all(), [
                'name'      => 'required',
                'mobile'    => 'required|numeric|unique:admins|unique:vendors',
                'address'   => 'required|string|max:100',
                'country'   => 'required|string|max:100',
                'state'     => 'required|string|max:100',
                'city'      => 'required|string|max:100',
                'email'     => 'required|email|unique:admins|unique:vendors',
                'password'  => 'required|min:6'
            ]);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }

            DB::beginTransaction();

            $vendor = new Vendor;
            $vendor->name   = $data['name'];
            $vendor->mobile = $data['mobile'];
            $vendor->address = $data['address'];
            $vendor->country = $data['country'];
            $vendor->state = $data['state'];
            $vendor->city = $data['city'];
            $vendor->email  = $data['email'];
            date_default_timezone_set('Asia/Jakarta');
            $vendor->created_at = date('Y-m-d H:i:s');
            $vendor->updated_at = date('Y-m-d H:i:s');
            $vendor->save();
            $vendor_id = DB::getPdo()->lastInsertId();

            $admin = new Admin;
            $admin->vendor_id = $vendor_id;
            $admin->type      = 'vendor';
            $admin->name      = $data['name'];
            $admin->mobile    = $data['mobile'];
            $admin->email     = $data['email'];
            $admin->password  = bcrypt($data['password']);
            date_default_timezone_set('Asia/Jakarta');
            $admin->created_at = date('Y-m-d H:i:s');
            $admin->updated_at = date('Y-m-d H:i:s');
            $admin->save();

            DB::commit();

            $message = 'Berhasil mendaftarkan akun sebagai penjual';

            return redirect()->back()->with('success_message', $message);
        }
    }
}
