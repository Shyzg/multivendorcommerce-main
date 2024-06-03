<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            [
                'id'        => 1,
                'vendor_id' => 0,
                'name'      => 'Jero',
                'type'      => 'superadmin',
                'mobile'    => '082233527616',
                'email'     => 'admin@admin.com',
                'password'  => '$2a$12$xvkjSScUPRexfcJTAy9ATutIeGUuRgJrjDIdL/.xlrddEvRZINpeC',
                'image'     => null
            ],
            [
                'id'        => 2,
                'vendor_id' => 1,
                'name'      => 'Reza',
                'type'      => 'vendor',
                'mobile'    => '082233521234',
                'email'     => 'reza@gmail.com',
                'password'  => '$2a$12$xvkjSScUPRexfcJTAy9ATutIeGUuRgJrjDIdL/.xlrddEvRZINpeC',
                'image'     => null
            ],
        ];

        Admin::insert($adminRecords);
    }
}
