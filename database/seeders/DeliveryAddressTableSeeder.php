<?php

namespace Database\Seeders;

use App\Models\DeliveryAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryRecords = [
            [
                'id'      => 1,
                'user_id' => 1,
                'name'    => 'Shyzago Nakamoto',
                'address' => 'Puri Lidah Kulon Indah D-10',
                'city'    => 'Kota Surabaya',
                'state'   => 'Jawa Timur',
                'country' => 'Indonesia',
                'mobile'  => 1255642718,
                'status'  => 1
            ]
        ];

        DeliveryAddress::insert($deliveryRecords);
    }
}
