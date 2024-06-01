<?php

namespace Database\Seeders;

use App\Models\Vendor;
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
                'name'    => 'Reza Mahendra',
                'address' => 'Puri Lidah Kulon Indah D-10',
                'city'    => 'Kota Surabaya',
                'state'   => 'Jawa Timur',
                'country' => 'Indonesia',
                'mobile'  => '082233521234',
                'email'   => 'reza@gmail.com'
            ],
        ];

        Vendor::insert($vendorRecords);
    }
}
