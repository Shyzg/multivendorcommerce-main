<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            [
                'id'      => 1,
                'name'    => 'Yasser Fouaad - Vendor',
                'address' => '17 El-Salam St.',
                'city'    => 'Maadi',
                'state'   => 'Cairo',
                'country' => 'Egypt',
                'mobile'  => '9700000000',
                'email'   => 'yasser@admin.com'
            ],
        ];

        \App\Models\Vendor::insert($vendorRecords);
    }
}
