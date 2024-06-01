@extends('front.layout.layout')

@section('content')
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Cart</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="#">Thanks</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="page-cart u-s-p-t-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" align="center">
                <h3>YOUR ORDER HAS BEEN PLACED SUCCESSFULLY</h3>
                <p>Your order number is {{ Session::get('order_id') }} and Grand Total is IDR
                    {{ Session::get('grand_total') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
@php
use Illuminate\Support\Facades\Session;

Session::forget('grand_total'); // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
Session::forget('order_id'); // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
Session::forget('couponCode'); // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
Session::forget('couponAmount'); // Deleting Data: https://laravel.com/docs/9.x/session#deleting-data
@endphp