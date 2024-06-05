<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Setiap 'product' memiliki relasi antara table 'section'
    public function section()
    {
        // Foreign key untuk 'section_id' 
        return $this->belongsTo(Section::class, 'section_id');
    }

    // Setiap 'product' memiliki relasi antara table 'category'
    public function category()
    {
        // Foreign key untuk 'category_id'
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Setiap 'product' memiliki banyak 'attribute'
    public function attributes()
    {
        return $this->hasMany(ProductsAttribute::class);
    }

    // Setiap 'product' memiliki banyak 'image'
    public function images()
    {
        return $this->hasMany(ProductsImage::class);
    }

    // Setiap 'product' memiliki relasi antara table `vendors` table
    public function vendor()
    {
        // Foreign key untuk 'vendor_id'
        return $this->belongsTo(Vendor::class, 'vendor_id')->with('vendorbusinessdetails');
    }

    public function orders_products()
    {
        // Foreign key untuk 'order_id' yang ada di kolom orders_products
        return $this->hasMany(OrdersProduct::class);
    }

    public static function getDiscountPrice($product_id)
    {
        // Ambil 'product_price', 'product_discount', dan 'category_id' untuk di tampilkan di front/index.blade.php
        $productDetails = Product::select('product_price', 'product_discount', 'category_id')->where('id', $product_id)->first();
        // Konversi object kedalam array
        $productDetails = json_decode(json_encode($productDetails), true);
        // Ambil 'product' dan potongan harga dari 'category_discount' di table `categories` menggungakan `category_id` di table `products`
        $categoryDetails = Category::select('category_discount')->where('id', $productDetails['category_id'])->first();
        // Konversi object kedalam array
        $categoryDetails = json_decode(json_encode($categoryDetails), true);

        if ($productDetails['product_discount'] > 0) {
            // Kalau ada 'product_discount' di dalam table 'products' yang nilainya bukan 0
            $discounted_price = $productDetails['product_price'] - ($productDetails['product_price'] * $productDetails['product_discount'] / 100);
        } else if ($categoryDetails['category_discount'] > 0) {
            // Kalau ada 'category_discount di dalam table 'categories' yang nilainya bukan 0
            $discounted_price = $productDetails['product_price'] - ($productDetails['product_price'] * $categoryDetails['category_discount'] / 100);
        } else {
            // Kalau gaada 'product_discount' dan 'category_discount di dalam table 'products' dan 'categories' yang nilainya bukan 0
            $discounted_price = 0;
        }

        return $discounted_price;
    }

    public static function getDiscountAttributePrice($product_id)
    {
        $prodPrice = Product::where(['id' => $product_id])->first();
        $proDetails = Product::select('product_discount', 'category_id')->where('id', $product_id)->first();
        $proDetails = json_decode(json_encode($proDetails), true);
        $catDetails = Category::select('category_discount')->where('id', $proDetails['category_id'])->first();
        $catDetails = json_decode(json_encode($catDetails), true);

        if ($proDetails['product_discount'] > 0) {
            // Kalau ada 'product_discount' di dalam table 'products' yang nilainya bukan 0
            $final_price = $prodPrice['product_price'] - ($prodPrice['product_price'] * $proDetails['product_discount'] / 100);
            $discount = $prodPrice['product_price'] - $final_price; // the discount value = original price - price after discount
        } else if ($catDetails['category_discount'] > 0) {
            // Kalau ada 'category_discount di dalam table 'categories' yang nilainya bukan 0
            $final_price = $prodPrice['product_price'] - ($prodPrice['product_price'] * $catDetails['category_discount'] / 100);
            $discount = $prodPrice['product_price'] - $final_price;
        } else {
            // Kalau gaada 'product_discount' dan 'category_discount di dalam table 'products' dan 'categories' yang nilainya bukan 0
            $final_price = $prodPrice['product_price'];
            $discount = 0;
        }

        return array(
            'product_price' => $prodPrice['product_price'],
            'final_price'   => $final_price,
            'discount'      => $discount
        );
    }

    public static function getProductImage($product_id)
    {
        // Fungsi ini di gunakan di front/orders/order_details.blade.php
        $getProductImage = Product::select('product_image')->where('id', $product_id)->first();

        return $getProductImage['product_image'];
    }
}
