<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        Session::put('page', 'users');

        $users = User::get()->toArray();

        return view('admin.users.users')->with(compact('users'));
    }
}
