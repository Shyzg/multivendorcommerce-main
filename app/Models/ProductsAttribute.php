<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsAttribute extends Model
{
    use HasFactory;

    public static function getProductStock($product_id)
    {
        $getProductStock = ProductsAttribute::select('stock')->where([
            'product_id' => $product_id
        ])->first();

        return $getProductStock->stock ?? null;
    }

    public static function getAttributeStatus($product_id)
    {
        $getAttributeStatus = ProductsAttribute::select('status')->where([
            'product_id' => $product_id
        ])->first();


        return $getAttributeStatus->status;
    }
}
