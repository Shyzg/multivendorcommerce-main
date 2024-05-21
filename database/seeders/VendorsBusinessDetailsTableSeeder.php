<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VendorsBusinessDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorsBusinessDetailsRecords = [
            [
                'id'                      => 1,
                'vendor_id'               => 1,
                'shop_name'               => 'John Electronics Store',
                'shop_address'            => '12 Mahmoud Saeed St.',
                'shop_city'               => 'New Cairo',
                'shop_state'              => 'Cairo',
                'shop_country'            => 'Egypt',
                'shop_mobile'             => '1253247745',
                'shop_website'            => 'amazon.com.eg',
                'shop_email'              => 'john@admin.com'
            ],
        ];

        \App\Models\VendorsBusinessDetail::insert($vendorsBusinessDetailsRecords);
    }
}
