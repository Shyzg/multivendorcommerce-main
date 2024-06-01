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
            // if there's a 'product_discount' (in `products` table) (i.e. discount is not zero 0)
            // if there's a PRODUCT discount on the product itself
            $final_price = $prodPrice['product_price'] - ($prodPrice['product_price'] * $proDetails['product_discount'] / 100);
            $discount = $prodPrice['product_price'] - $final_price; // the discount value = original price - price after discount
        } else if ($catDetails['category_discount'] > 0) {
            // if there's a `category_discount` (in `categories` table) (i.e. discount is not zero 0) (if there's a discount on the whole category of that product)
            // if there's NO a PRODUCT discount, but there's a CATEGORY discount
            $final_price = $prodPrice['product_price'] - ($prodPrice['product_price'] * $catDetails['category_discount'] / 100);
            $discount = $prodPrice['product_price'] - $final_price; // the discount value = original price - price after discount
            // Note: Didn't ACCOUNT FOR presence of discounts of BOTH `product_discount` (in `products` table) AND `category_discount` (in `categories` table) AT THE SAME TIME!!
        } else {
            // there's no discount on neither `product_discount` (in `products` table) nor `category_discount` (in `categories` table)
            $final_price = $prodPrice['product_price'];
            $discount = 0;
        }

        return array(
            'product_price' => $prodPrice['product_price'],
            'final_price'   => $final_price,
            'discount'      => $discount
        );
    }

    public static function isProductNew($product_id)
    {
        // Ambil 3 terakhir dari product yang baru ditambahlam
        $productIds = Product::select('id')->where('status', 1)->orderBy('id', 'Desc')->limit(3)->pluck('id');
        $productIds = json_decode(json_encode($productIds, true));

        if (in_array($product_id, $productIds)) {
            // Jika berhasil melewati $product_id di dalam array yang baru ditambahkan
            $isProductNew = 'Yes';
        } else {
            $isProductNew = 'No';
        }

        return $isProductNew;
    }

    public static function getProductImage($product_id)
    {
        // Fungsi ini di gunakan di front/orders/order_details.blade.php
        $getProductImage = Product::select('product_image')->where('id', $product_id)->first()->toArray();

        return $getProductImage['product_image'];
    }

    public static function deleteCartProduct($product_id)
    {
        Cart::where('product_id', $product_id)->delete();
    }
}
