<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'section_id'       => 2,
                'category_id'      => 1,
                'vendor_id'        => 1,
                'admin_id'         => 2,
                'admin_type'       => 'vendor',
                'product_name'     => 'Redmi Note 11',
                'product_code'     => 'RN11',
                'product_price'    => 15000,
                'product_discount' => 10,
                'product_weight'   => 500,
                'product_weight'   => 500,
                'product_image'    => '',
                'is_featured'      => 'Yes',
                'status'           => 1,
            ],
            [
                'id'               => 2,
                'section_id'       => 1,
                'category_id'      => 1,
                'vendor_id'        => 0,
                'admin_id'         => 1,
                'admin_type'       => 'superadmin',
                'product_name'     => 'Red Casual T-Shirt',
                'product_code'     => 'RC001',
                'product_price'    => 1000,
                'product_discount' => 20,
                'product_weight'   => 200,
                'product_weight'   => 500,
                'product_image'    => '',
                'is_featured'      => 'Yes',
                'status'           => 1,
            ],
        ];

        // Note: Check DatabaseSeeder.php
        \App\Models\Product::insert($productRecords);
    }
}
