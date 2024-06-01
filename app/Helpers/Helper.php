<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

function totalCartItems()
{
    if (Auth::check()) {
        // Memeriksa apakah customer telah masuk kedalam akun atau login dan memeriksa berapakah customer tersebut memiliki barang belanjaan dalam keranjang, yang akan ditampilkan dihalaman utama pada header.blade.php
        $user_id = Auth::user()->id;
        $totalCartItems = Cart::where('user_id', $user_id)->sum('quantity');
    } else {
        // Memeriksa apakah customer telah keluar kedalam akun atau logout dan memeriksa dalam session tersebut berapakah memiliki barang belanjaan dalam keranjang
        $session_id = Session::get('session_id');
        $totalCartItems = Cart::where('session_id', $session_id)->sum('quantity');
    }

    return $totalCartItems;
}

function getCartItems()
{
    if (Auth::check()) {
        // Kalo customer telah masuk kedalam akun atau login, akan melakukan pengambilan data produk atau item dalam keranjang melalui 'user_id' dan session_id yang ada didalam tabel carts
        $getCartItems = Cart::with([
            // Relasi atau hubungan nama method product() dalam model Cart.php
            'product' => function ($query) {
                $query->select('id', 'category_id', 'product_name', 'product_image');
                // Dalam query ini akan melakukan select 'id' karna relasi foreign key dari 'product_id' akan bergantung pada table 'product', jika tidak relasi atau hubungan pada 'product' ada akan mengembalikan nilai null
            }
        ])->orderBy('id', 'Desc')->where([
            // Melalui customer yang telah masuk kedalam akun atau login
            'user_id'    => Auth::user()->id
        ])->get();
    } else {
        // Kalo customer telah keluar kedalam akun atau logout, akan melakukan pengambilan data produk atau item dalam keranjang hanya melalui 'session_id'
        $getCartItems = Cart::with([
            'product' => function ($query) {
                $query->select('id', 'category_id', 'product_name', 'product_image');
            }
        ])->orderBy('id', 'Desc')->where([
            'session_id' => Session::get('session_id')
        ])->get();
    }

    return $getCartItems;
}
