<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function orders_products()
    {
        // 'order_id' (column of `orders_products` table) is the Foreign Key of the Relationship
        return $this->hasMany(OrdersProduct::class, 'order_id');
    }
}
