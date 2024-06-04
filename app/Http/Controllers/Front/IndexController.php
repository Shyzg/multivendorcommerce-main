<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $newProducts = Product::orderBy('id', 'Desc')->limit(8)->get();
        $bestSellers = Product::where(['is_bestseller' => 'Yes'])->inRandomOrder()->get();
        $discountedProducts = Product::where('product_discount', '>', 0)->limit(6)->inRandomOrder()->get();
        $makanan = Product::with('category')->whereHas('category', fn ($query) => $query->where('category_name', 'Makanan'))->get();
        $minuman = Product::with('category')->whereHas('category', fn ($query) => $query->where('category_name', 'Minuman'))->get();

        return view('front.index')->with(compact('newProducts', 'bestSellers', 'discountedProducts', 'makanan', 'minuman'));
    }
}
