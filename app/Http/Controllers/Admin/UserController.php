<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\User;

class UserController extends Controller
{
    public function users()
    {
        Session::put('page', 'users');

        $users = User::get()->toArray();

        return view('admin.users.users')->with(compact('users'));
    }
}
