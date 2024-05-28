<?php

namespace Database\Seeders;

use App\Models\VendorsBusinessDetail;
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
                'shop_name'               => 'HaverCrunch',
                'shop_address'            => 'Puri Lidah Kulon Indah D-10',
                'shop_city'               => 'Kota Surabaya',
                'shop_state'              => 'Jawa Timur',
                'shop_country'            => 'Indonesia',
                'shop_mobile'             => '1253247745',
                'shop_website'            => 'amazon.com.eg',
                'shop_email'              => 'john@admin.com'
            ],
        ];

        VendorsBusinessDetail::insert($vendorsBusinessDetailsRecords);
    }
}
