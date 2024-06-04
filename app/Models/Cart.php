<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'session_id',
        'quantity',
    ];

    // Relationship of a Cart Item `carts` table with a Product `products` table (every cart item belongs to a product)    
    public function product()
    {
        // A Product `products` belongs to a Vendor `vendors`, and the Foreign Key of the Relationship is the `product_id` column
        return $this->belongsTo(Product::class, 'product_id'); // 'product_id' is the Foreign Key of the Relationship
    }

    public static function getCartItems()
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

    public static function destroyCartItems()
    {
        if (Auth::check()) {
            return $getCartItems = Cart::where('user_id', Auth::user()->id)->delete();
        }

        return false;
    }
}
