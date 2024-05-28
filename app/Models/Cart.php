<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class Cart extends Model
{
    use HasFactory;

    // Relationship of a Cart Item `carts` table with a Product `products` table (every cart item belongs to a product)    
    public function product()
    { // A Product `products` belongs to a Vendor `vendors`, and the Foreign Key of the Relationship is the `product_id` column
        return $this->belongsTo('App\Models\Product', 'product_id'); // 'product_id' is the Foreign Key of the Relationship
    }



    // Get the Cart Items of a cerain user (using their `user_id` if they're authenticated/logged in or their `session_id` if they're not authenticated/not logged in (guest))    
    public static function getCartItems()
    {
        if (Auth::check()) {
            $getCartItems = Cart::with([
                'product' => function ($query) {
                    $query->select('id', 'category_id', 'product_name', 'product_image', 'product_weight');
                }
            ])->orderBy('id', 'Desc')->where([
                'user_id'    => Auth::user()->id
            ])->get()->toArray();
        } else {
            $getCartItems = Cart::with([
                'product' => function ($query) {
                    $query->select('id', 'category_id', 'product_name', 'product_image', 'product_weight');
                }
            ])->orderBy('id', 'Desc')->where([
                'session_id' => Session::get('session_id')
            ])->get()->toArray();
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
