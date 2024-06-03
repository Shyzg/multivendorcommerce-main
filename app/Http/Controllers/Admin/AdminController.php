<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Models\Admin;
use App\Models\Section;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorsBusinessDetail;
use App\Models\Country;
use App\Models\Province;
use App\Models\City;

class AdminController extends Controller
{
    // Menampilkan halaman coupon di dashboard admin pada views admin/dashboard
    public function dashboard()
    {
        // Fungsi session ini digunakan untuk menyimpan dalam sesi menggunakan method put() dengan kata key 'page' yang berisikan nilai 'dashboard', jadi ketika key 'page' dipanggil dan memiliki nilai 'dashboard' dapat menampilkan beberapa data yang dipanggil dibawah
        Session::put('page', 'dashboard');

        $sectionsCount   = Section::count();
        $categoriesCount = Category::count();
        $productsCount   = Product::count();
        $ordersCount     = Order::count();
        $couponsCount    = Coupon::count();
        $usersCount      = User::count();

        // Mengembalikan variable berupa array yang ada diatas kedalam halaman dashboard admin
        return view('admin/dashboard')->with(compact('sectionsCount', 'categoriesCount', 'productsCount', 'ordersCount', 'couponsCount', 'usersCount'));
    }

    public function admins()
    {
        $admins = Admin::get();

        Session::put('page', 'admins');

        return view('admin.admins.admins')->with(compact('admins'));
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'email'    => 'required|email|max:255',
                'password' => 'required',
            ];
            $customMessages = [
                'email.required'    => 'Email harus diisi',
                'email.email'       => 'Masukkan alamat email dengan benar',
                'password.required' => 'Kata sandi harus diisi',
            ];

            // Melakukan validasi data yang dikirim apakah benar, jika tidak akan menampilkan pesan error
            $this->validate($request, $rules, $customMessages);

            // Melakukan autentikasi user/admin/vendor
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                // Kalau benar proses autentikasi valid dengan yang ada di database akan mengarahkan kedalam dashboard admin
                return redirect('/admin/dashboard');
            } else {
                // Kalau data yang dimasukkan atau dikirim tidak valid dengan yang ada di database akan menampilkan pesan error
                return redirect()->back()->with('error_message', 'Email atau kata sandi tidak benar');
            }
        }

        return view('admin/login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('admin/login');
    }

    public function updateAdminPassword(Request $request)
    {
        Session::put('page', 'update_admin_password');

        // Mengambil data untuk memperbarui password admin pada form yang ada di update_admin_password.blade.php
        if ($request->isMethod('post')) {
            $data = $request->all();

            // Memeriksa terlebih dahulu apakah password yang dimasukkan user/admin  sama dengan password yang sedang digunakan sekarang
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                // Memeriksa apakah password baru yang dimasukkan oleh user/admin sama antara 'new_password' dan 'confirm_password'
                if ($data['confirm_password'] == $data['new_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update([
                        'password' => bcrypt($data['new_password'])
                    ]);

                    // Jika sama maka akan menampilkan pesan sukses
                    return redirect()->back()->with('success_message', 'Berhasil memperbarui kata sandi admin');
                } else {
                    // Jika tidak sama maka akan menampilkan pesan error
                    return redirect()->back()->with('error_message', 'Kata sandi baru dan konfirmasi kata sandi tidak sama');
                }
            } else {
                // Jika password admin yang sedang digunakan tidak valid akan menampilkan pesan error
                return redirect()->back()->with('error_message', 'Kata sandi yang sedang digunakan saat ini tidak sesuai');
            }
        }

        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();

        return view('admin/settings/update_admin_password')->with(compact('adminDetails'));
    }

    public function checkAdminPassword(Request $request)
    {
        $data = $request->all();

        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function updateAdminDetails(Request $request)
    {
        Session::put('page', 'update_admin_details');

        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'admin_name'   => 'required',
                'admin_mobile' => 'required|numeric',
            ];
            $customMessages = [
                'admin_name.required'   => 'Nama harus diisi',
                'admin_mobile.required' => 'Nomor handphone harus diisi',
                'admin_mobile.numeric'  => 'Nomor handphone harus diiskan dengan angka',
            ];

            $this->validate($request, $rules, $customMessages);

            // Jika admin mengunggah file berupa foto atau image, maka akan dilakukan proses pengunggahan pada folder admin/images/photos
            if ($request->hasFile('admin_image')) {
                $image_tmp = $request->file('admin_image');

                if ($image_tmp->isValid()) {
                    // Mengambil ekstensi foto atau gambar
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate angka acak sebagai nama file foto agar tidak mengalami penimbunan foto
                    $imageName = rand(111, 99999) . '.' . $extension;
                    // Memasukkan file yang diunggah kedalam folder 'public'
                    $imagePath = 'admin/images/photos/' . $imageName;

                    // Melakukan penyimpanan menggunakan package laravel yaitu IntervationImage
                    Image::make($image_tmp)->save($imagePath);
                }
            } else if (!empty($data['current_admin_image'])) {
                $imageName = $data['current_admin_image'];
            } else {
                $imageName = '';
            }

            // Memperbarui detail admin
            Admin::where('id', Auth::guard('admin')->user()->id)->update([
                'name'   => $data['admin_name'],
                'mobile' => $data['admin_mobile'],
                'image'  => $imageName
            ]);

            return redirect()->back()->with('success_message', 'Berhasil memperbarui informasi admin');
        }

        return view('admin/settings/update_admin_details');
    }

    public function updateVendorDetails($slug, Request $request)
    {
        $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first();

        // $slug hanya dapat digunakan pada halaman personal_details atau business_details
        if ($slug == 'personal') {
            Session::put('page', 'update_personal_details');

            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'vendor_name'   => 'required',
                    'vendor_city'   => 'required',
                    'vendor_mobile' => 'required|numeric',
                ];
                $customMessages = [
                    'vendor_name.required'   => 'Nama harus diisi',
                    'vendor_city.required'   => 'Kota harus diisi',
                    'vendor_mobile.required' => 'Nomor handphone harus diisi',
                    'vendor_mobile.numeric'  => 'Masukkan nomor handphone hanya menggunakan angka',
                ];
                $this->validate($request, $rules, $customMessages);

                if ($request->hasFile('vendor_image')) {
                    $image_tmp = $request->file('vendor_image');
                    if ($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin/images/photos/' . $imageName;

                        Image::make($image_tmp)->save($imagePath);
                    }
                } else if (!empty($data['current_vendor_image'])) {
                    $imageName = $data['current_vendor_image'];
                } else {
                    $imageName = '';
                }

                Admin::where('id', Auth::guard('admin')->user()->id)->update([
                    'name'   => $data['vendor_name'],
                    'mobile' => $data['vendor_mobile'],
                    'image'  => $imageName
                ]);
                Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update([
                    'name'    => $data['vendor_name'],
                    'mobile'  => $data['vendor_mobile'],
                    'address' => $data['vendor_address'],
                    'city'    => $data['vendor_city'],
                    'state'   => $data['vendor_state'],
                    'country' => $data['vendor_country']
                ]);

                return redirect()->back()->with('success_message', 'Berhasil memperbarui informasi penjual');
            }
        } else if ($slug == 'business') {
            Session::put('page', 'update_business_details');

            $vendorCount = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count();
            if ($vendorCount > 0) {
                $vendorDetails = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first();
            } else {
                $vendorDetails = array();
            }

            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'shop_name'           => 'required',
                    'shop_city'           => 'required',
                    'shop_mobile'         => 'required|numeric'
                ];
                $customMessages = [
                    'shop_name.required'           => 'Nama harus diisi',
                    'shop_city.required'           => 'Kota harus diisi',
                    'shop_mobile.required'         => 'Nomor handphone harus diisi',
                    'shop_mobile.numeric'          => 'Masukkan nomor handphone hanya menggunakan angka',
                ];
                $this->validate($request, $rules, $customMessages);

                $vendorCount = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count();

                if ($vendorCount > 0) {
                    // Jika 'vendor_id' dalam table 'admins' lebih dari 1 dan telah memiliki data bisnis detail sebelumnya, maka dapat melakukan memperbarui atau update kedalam 'vendor_business_detail'
                    VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update([
                        'shop_name'               => $data['shop_name'],
                        'shop_mobile'             => $data['shop_mobile'],
                        'shop_address'            => $data['shop_address'],
                        'shop_city'               => $data['shop_city'],
                        'shop_state'              => $data['shop_state'],
                        'shop_country'            => $data['shop_country']
                    ]);
                } else {
                    // Sedangkan 'vendor_id' dalam table 'admins' lebih dari 1 dan belum memiliki bisnis detail sebelumnya, akan menambahkan atau insert kedalam table 'vendor_business_detail'
                    VendorsBusinessDetail::insert([
                        'vendor_id'               => Auth::guard('admin')->user()->vendor_id,
                        'shop_name'               => $data['shop_name'],
                        'shop_mobile'             => $data['shop_mobile'],
                        'shop_address'            => $data['shop_address'],
                        'shop_city'               => $data['shop_city'],
                        'shop_state'              => $data['shop_state'],
                        'shop_country'            => $data['shop_country']
                    ]);
                }

                return redirect()->back()->with('success_message', 'Berhasil memperbarui informasi toko');
            }
        }

        $countries = Country::orderBy('name', 'asc')->get();
        $cities = City::orderBy('name', 'asc')->get();
        $provinces = Province::orderBy('name', 'asc')->get();

        return view('admin/settings/update_vendor_details')->with(compact('slug', 'vendorDetails', 'countries', 'cities', 'provinces'));
    }

    public function viewVendorDetails($id)
    {
        $vendorDetails = Admin::with('vendorPersonal', 'vendorBusiness')->where('id', $id)->first();
        // Konversi variable dalam php untuk menjadi string json
        $vendorDetails = json_decode(json_encode($vendorDetails), true);

        return view('admin/admins/view_vendor_details')->with(compact('vendorDetails'));
    }
}
