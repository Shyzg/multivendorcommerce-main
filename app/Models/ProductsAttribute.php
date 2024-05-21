<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsAttribute extends Model
{
    use HasFactory;


    
    public static function getProductStock($product_id) { // Get the `stock` available for that specific product (`product_id`) with that specific size (`size`) (in `products_attributes` table)?
        $getProductStock = ProductsAttribute::select('stock')->where([
            'product_id' => $product_id,
            // 'size'       => $size
        ])->first();

        // dd($product_id);
        return $getProductStock->stock ?? null;
    }

    
    // Note: We need to prevent orders (upon checkout and payment) of the 'disabled' products (`status` = 0), where the product ITSELF can be disabled in admin/products/products.blade.php (by checking the `products` database table) or a product's attribute (`stock`) can be disabled in 'admin/attributes/add_edit_attributes.blade.php' (by checking the `products_attributes` database table). We also prevent orders of the out of stock / sold-out products (by checking the `products_attributes` database table)
    public static function getAttributeStatus($product_id) {
        $getAttributeStatus = ProductsAttribute::select('status')->where([
            'product_id' => $product_id,
            // 'size'       => $size
        ])->first();


        return $getAttributeStatus->status;
    }

}