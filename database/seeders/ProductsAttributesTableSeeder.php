<?php

namespace Database\Seeders;

use App\Models\ProductsAttribute;
use Illuminate\Database\Seeder;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributesRecords = [
            [
                'id'         => 1,
                'product_id' => 1,
                'stock'      => 10,
                'sku'        => 'MKN1',
                'status'     => 1
            ]
        ];

        ProductsAttribute::insert($productAttributesRecords);
    }
}
