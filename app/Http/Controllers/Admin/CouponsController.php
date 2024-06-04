<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Coupon;
use App\Models\Section;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class CouponsController extends Controller
{
    // Menampilkan halaman coupon di dashboard admin pada views admin/coupons/coupons.blade.php
    public function coupons()
    {
        // Menggunakan session untuk sebagai penanda halaman yang sedang digunakan pada sidebar
        Session::put('page', 'coupons');

        $adminType = auth('admin')->user()->type;
        $vendor_id = auth('admin')->user()->vendor_id;
        // Mengambil daftar kupon berdasarkan tipe pengguna admin
        // Kala admin tipenya vendor hanya kupon yang terkait dengan vendor tersebut yang diambil
        // Sedangkan kalau tidak semua kupon diambil
        $coupons = Coupon::when($adminType == 'vendor', function ($query) use ($vendor_id) {
            return $query->where('vendor_id', $vendor_id);
        })->get();

        return view('admin.coupons.coupons', compact('coupons'));
    }

    public function addEditCoupon(Request $request, $id = null)
    {
        Session::put('page', 'coupons');

        // Mengambil daftar kategori produk dan pengguna
        $categories = Section::with('categories')->get();
        $users = User::select('email')->get();

        // Menetapkan judul berdasarkan apakah itu penambahan atau pengeditan
        if ($id == '') {
            $title = 'Tambah Kupon';
            $coupon = new Coupon;
            $selCats = $selUsers = [];
            $message = 'Berhasil menambahkan kupon';
        } else {
            $title = 'Ubah Kupon';
            $coupon = Coupon::find($id);
            // Memisahkan string $coupon->categories menjadi array
            $selCats = explode(',', $coupon->categories);
            // Memisahkan string $coupon->users menjadi array
            $selUsers = explode(',', $coupon->users);
            $message = 'Berhasil memperbarui kupon';
        }

        // Memproses data jika permintaan adalah POST
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($request->all(), [
                'categories'    => 'required',
                'coupon_option' => 'required',
                'coupon_type'   => 'required',
                'amount_type'   => 'required',
                'amount'        => 'required|numeric',
                'expiry_date'   => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Mengubah array kategori menjadi string
            $categories = isset($data['categories']) ? implode(',', $data['categories']) : '';
            // Mengubah array pengguna menjadi string
            $users = isset($data['users']) ? implode(',', $data['users']) : '';
            // Menyiapkan kode kupon
            $coupon_code = $data['coupon_option'] == 'Automatic' ? Str::random(8) : $data['coupon_code'];

            // Menetapkan vendor_id berdasarkan jenis admin yang saat ini masuk
            $coupon->vendor_id = Auth::guard('admin')->user()->type == 'vendor' ? Auth::guard('admin')->user()->vendor_id : 0;
            // Menetapkan nilai atribut kupon
            $coupon->coupon_option = $data['coupon_option'];
            $coupon->coupon_code = $coupon_code;
            $coupon->categories = $categories;
            $coupon->users = $users;
            $coupon->coupon_type = $data['coupon_type'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->amount = $data['amount'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->save();

            return redirect('admin/coupons')->with('success_message', $message);
        }

        return view('admin.coupons.add_edit_coupon', compact('title', 'coupon', 'categories', 'users', 'selCats', 'selUsers'));
    }

    public function deleteCoupon($id)
    {
        Coupon::where('id', $id)->delete();

        $message = 'Berhasil menghapus coupon';

        return redirect()->back()->with('success_message', $message);
    }
}
