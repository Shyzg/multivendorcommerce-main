<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class IndexController extends Controller
{
    public function index()
    {
        $newProducts   = Product::orderBy('id', 'Desc')->where('status', 1)->limit(8)->get()->toArray();
        $bestSellers   = Product::where([
            'is_bestseller' => 'Yes',
            'status'        => 1
        ])->inRandomOrder()->get()->toArray();
        $discountedProducts = Product::where('product_discount', '>', 0)->where('status', 1)->limit(6)->inRandomOrder()->get()->toArray();
        $featuredProducts   = Product::where([
            'is_featured' => 'Yes',
            'status'      => 1
        ])->limit(6)->get()->toArray();

        return view('front.index')->with(compact('newProducts', 'bestSellers', 'discountedProducts', 'featuredProducts'));
    }
}
