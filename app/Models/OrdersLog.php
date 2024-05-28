<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersLog extends Model
{
    use HasFactory;

    public function orders_products()
    {
        // Foreign key untuk 'order_id' dalam kolom table 'orders_products'
        return $this->hasMany('App\Models\OrdersProduct', 'id', 'order_item_id');
    }

    public static function getItemDetails($order_item_id)
    {
        $getItemDetails = \App\Models\OrdersProduct::where('id', $order_item_id)->first()->toArray();

        return $getItemDetails;
    }
}
