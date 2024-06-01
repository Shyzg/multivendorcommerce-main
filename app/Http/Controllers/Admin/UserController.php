<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class UserController extends Controller
{
    public function users()
    {
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
