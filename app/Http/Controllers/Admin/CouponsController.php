<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;
use App\Models\Section;
use App\Models\User;
use Illuminate\Support\Str;

class CouponsController extends Controller
{
    // Menampilkan halaman coupon di dashboard admin pada views admin/coupons/coupons.blade.php
    public function coupons()
    {
        // Menggunakan session untuk sebagai penanda halaman yang sedang digunakan pada sidebar
        Session::put('page', 'coupons');

        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;

        if ($adminType == 'vendor') {
            $coupons = Coupon::where('vendor_id', $vendor_id)->get();
        } else {
            $coupons = Coupon::get();
        }

        return view('admin.coupons.coupons')->with(compact('coupons'));
    }

    public function addEditCoupon(Request $request, $id = null)
    {
        Session::put('page', 'coupons');

        $categories = Section::with('categories')->get();
        $users = User::select('email')->get();

        if ($id == '') {
            $title = 'Tambah Kupon';
            $coupon = new Coupon;
            $selCats   = array();
            $selUsers  = array();
            $message = 'Berhasil menambahkan coupon';
        } else {
            $title = 'Ubah Kupon';
            $coupon = Coupon::find($id);
            // Memisahkan data dalam bentuk string untuk menjadi array contoh (['Makanan', 'Minuman'])
            $selCats   = explode(',', $coupon['categories']);
            $selUsers  = explode(',', $coupon['users']);
            $message = 'Berhasil memperbarui coupon';
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
                'categories.required'    => 'Harus memilih kategori',
                'coupon_option.required' => 'Harus memilih opsi kupon',
                'coupon_type.required'   => 'Harus memilih tipe kupon',
                'amount_type.required'   => 'Harus memilih tipe jumlah',
                'amount.required'        => 'Jumlah tipe kupon harus diisi',
                'amount.numeric'         => 'Jumlah tipe kupon harus diisikan dengan angka',
                'expiry_date.required'   => 'Harus memilih tanggal berakhir kupon',
            ];

            $this->validate($request, $rules, $customMessages);

            if (isset($data['categories'])) {
                // Menggabungkan data dalam bentuk array untuk jadi satu string contoh ("Makanan,Minuman")
                $categories = implode(',', $data['categories']);
            } else {
                $categories = '';
            }
            if (isset($data['users'])) {
                // Menggabungkan data dalam bentuk array untuk jadi satu string contoh ("Jero,Reza,Abel")
                $users = implode(',', $data['users']);
            } else {
                $users = '';
            }
            if ($data['coupon_option'] == 'Automatic') {
                // Akan otomatis memberikan kupon kode berupa string yang acak
                $coupon_code = Str::random(8);
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
            $coupon->save();

            return redirect('admin/coupons')->with('success_message', $message);
        }

        return view('admin.coupons.add_edit_coupon')->with(compact('title', 'coupon', 'categories', 'users', 'selCats', 'selUsers'));
    }

    public function deleteCoupon($id)
    {
        Coupon::where('id', $id)->delete();

        $message = 'Berhasil menghapus coupon';

        return redirect()->back()->with('success_message', $message);
    }
}
