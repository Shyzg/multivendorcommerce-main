<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            [
                'id'               => 1,
                'section_id'       => 1,
                'category_id'      => 1,
                'vendor_id'        => 1,
                'admin_id'         => 2,
                'admin_type'       => 'vendor',
                'product_name'     => 'Makanan Sehat Alpha',
                'product_price'    => 15000,
                'product_discount' => 10,
                'product_weight'   => 500,
                'product_weight'   => 500,
                'product_image'    => '',
                'is_featured'      => 'Yes',
                'status'           => 1,
            ]
        ];

        Product::insert($productRecords);
    }
}
