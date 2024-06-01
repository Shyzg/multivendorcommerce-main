<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class UserController extends Controller
{
    // Menampilkan halaman coupon di dashboard admin pada views admin/users/users.blade.php
    public function users()
    {
        // Menggunakan session untuk sebagai penanda halaman yang sedang digunakan pada sidebar
        Session::put('page', 'users');

        $users = User::get();

        return view('admin.users.users')->with(compact('users'));
    }

    public function deleteUser($id)
    {
        User::where('id', $id)->delete();

        $message = 'Berhasil menghapus customer';

        return redirect()->back()->with('success_message', $message);
    }
}
