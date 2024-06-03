<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function loginRegister()
    {
        $countries = Country::orderBy('name', 'asc')->get();
        $cities = City::orderBy('name', 'asc')->get();
        $provinces = Province::orderBy('name', 'asc')->get();

        return view('front.users.login_register')->with(compact('countries', 'cities', 'provinces'));;
    }

    public function userRegister(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($request->all(), [
                'name'      => 'required|string|min:2|max:128',
                'mobile'    => 'required|numeric|min_digits:10|max_digits:12',
                'address'   => 'required|string|max:100',
                'country'   => 'required|string|max:100',
                'state'     => 'required|string|max:100',
                'city'      => 'required|string|max:100',
                'email'     => 'required|email|max:150|unique:users',
                'password'  => 'required|min:6'
            ]);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }

            DB::beginTransaction();

            $user = new User;
            $user->name     = $data['name'];
            $user->mobile   = $data['mobile'];
            $user->address  = $data['address'];
            $user->country  = $data['country'];
            $user->state    = $data['state'];
            $user->city     = $data['city'];
            $user->email    = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

            DB::commit();

            $message = 'Berhasil mendaftarkan akun sebagai pembeli';

            return redirect()->back()->with('success_message', $message);
        }
    }

    public function userLogin(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $validator = Validator::make($request->all(), [
                'email'    => 'required|email|max:150|exists:users',
                'password' => 'required|min:6'
            ]);

            if ($validator->passes()) {
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
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
                        'message' => 'Email atau Password tidak benar'
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
            $validator = Validator::make($request->all(), [
                'name'    => 'required|string|max:100',
                'mobile'  => 'required|numeric|digits:12',
                'address' => 'required|string|max:100',
                'city'    => 'required|string|max:100',
                'state'   => 'required|string|max:100',
                'country' => 'required|string|max:100'
            ]);

            if ($validator->passes()) {
                User::where('id', Auth::user()->id)->update([
                    'name'    => $data['name'],
                    'mobile'  => $data['mobile'],
                    'address' => $data['address'],
                    'city'    => $data['city'],
                    'state'   => $data['state'],
                    'country' => $data['country']
                ]);

                return response()->json([
                    'type'    => 'success',
                    'message' => 'Berhasil mengubah informasi akun'
                ]);
            } else {
                return response()->json([
                    'type'   => 'error',
                    'errors' => $validator->messages()
                ]);
            }
        } else {
            $countries = Country::orderBy('name', 'asc')->get();
            $cities = City::orderBy('name', 'asc')->get();
            $provinces = Province::orderBy('name', 'asc')->get();

            return view('front.users.user_account')->with(compact('countries', 'cities', 'provinces'));
        }
    }

    public function userUpdatePassword(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $validator = Validator::make($request->all(), [
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
                        'message' => 'Berhasil mengubah kata sandi akun'
                    ]);
                } else {
                    return response()->json([
                        'type'    => 'incorrect',
                        'message' => 'Kata sandi yang digunakan saat ini tidak sesuai'
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
