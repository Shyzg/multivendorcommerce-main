<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingCharge;
class ShippingChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShippingCharge::create([
            'country' => 'Indonesia',
            '0_500g' => 0,
            '501g_1000g' => 0, 
            '1001_2000g' =>  0,
            '2001g_5000g' => 0,
            'above_5000g' => 0,
            'status' => 1
        ]);
    }
}
