<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Cart;

class UserController extends Controller
{
    public function loginRegister()
    {
        return view('front.users.login_register');
    }

    public function userRegister(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'name'     => 'required|string|max:100',
                'mobile'   => 'required|numeric|digits:11',
                'email'    => 'required|email|max:150|unique:users',
                'password' => 'required|min:6'
            ]);

            if ($validator->passes()) {
                $user = new User;
                $user->name     = $data['name'];
                $user->mobile   = $data['mobile'];
                $user->email    = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();

                $redirectTo = url('user/login-register');

                return response()->json([
                    'type'    => 'success',
                    'url'     => $redirectTo,
                    'message' => 'Berhasil mendaftarkan akun.'
                ]);
            } else {
                return response()->json([
                    'type'   => 'error',
                    'errors' => $validator->messages()
                ]);
            }
        }
    }

    public function userLogin(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'email'    => 'required|email|max:150|exists:users',
                'password' => 'required|min:6'
            ]);

            if ($validator->passes()) {
                if (Auth::attempt([
                    'email'    => $data['email'],
                    'password' => $data['password']
                ])) {
                    if (!empty(Session::get('session_id'))) {
                        $user_id    = Auth::user()->id;
                        $session_id = Session::get('session_id');

                        Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                    }

                    $redirectTo = url('cart');

                    return response()->json([
                        'type' => 'success',
                        'url'  => $redirectTo
                    ]);
                } else {
                    return response()->json([
                        'type'    => 'incorrect',
                        'message' => 'Incorrect Email or Password! Wrong Credentials!'
                    ]);
                }
            } else {
                return response()->json([
                    'type'   => 'error',
                    'errors' => $validator->messages()
                ]);
            }
        }
    }

    public function userLogout()
    {
        Auth::logout();

        Session::flush();

        return redirect('/');
    }

    public function userAccount(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'name'    => 'required|string|max:100',
                'city'    => 'required|string|max:100',
                'state'   => 'required|string|max:100',
                'address' => 'required|string|max:100',
                'country' => 'required|string|max:100',
                'mobile'  => 'required|numeric|digits:11',
                'pincode' => 'required|digits:6',
            ]);

            if ($validator->passes()) {
                User::where('id', Auth::user()->id)->update([
                    'name'    => $data['name'],
                    'mobile'  => $data['mobile'],
                    'city'    => $data['city'],
                    'state'   => $data['state'],
                    'country' => $data['country'],
                    'pincode' => $data['pincode'],
                    'address' => $data['address'],
                ]);

                return response()->json([
                    'type'    => 'success',
                    'message' => 'Your contact/billing details successfully updated!'
                ]);
            } else {
                return response()->json([
                    'type'   => 'error',
                    'errors' => $validator->messages()
                ]);
            }
        } else {
            $countries = \App\Models\Country::where('status', 1)->get()->toArray();
            $cities = \App\Models\City::get()->toArray();
            $province = \App\Models\Province::get()->toArray();

            return view('front.users.user_account')->with(compact('countries', 'cities', 'province'));
        }
    }

    public function userUpdatePassword(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'current_password'  => 'required',
                'new_password'     => 'required|min:6',
                'confirm_password' => 'required|min:6|same:new_password'
            ]);

            if ($validator->passes()) {
                $current_password = $data['current_password'];
                $checkPassword    = User::where('id', Auth::user()->id)->first();

                if (Hash::check($current_password, $checkPassword->password)) {
                    $user = User::find(Auth::user()->id);
                    $user->password = bcrypt($data['new_password']);
                    $user->save();

                    return response()->json([
                        'type'    => 'success',
                        'message' => 'Account password successfully updated!'
                    ]);
                } else {
                    return response()->json([
                        'type'    => 'incorrect',
                        'message' => 'Your current password is incorrect!'
                    ]);
                }
            } else {
                return response()->json([
                    'type'   => 'error',
                    'errors' => $validator->messages()
                ]);
            }
        }
    }
}
