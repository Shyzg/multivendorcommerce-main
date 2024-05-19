<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class MidtransController extends Controller
{
    public function midtrans()
    {
        if (Session::has('order_id')) {
            return view('front.iyzipay.iyzipay');
        } else {
            return redirect('cart');
        }
    }
}
