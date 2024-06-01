<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $couponRecords = [
            'id'            => 1,
            'vendor_id'     => 0,
            'coupon_option' => 'Manual',
            'coupon_code'   => 'Welcome',
            'categories'    => 1,
            'users'         => '',
            'coupon_type'   => 'Single Time',
            'amount_type'   => 'Percentage',
            'amount'        => 10,
            'expiry_date'   => '2022-12-31'
        ];

        Coupon::insert($couponRecords);
    }
}
