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
                'name'      => 'Jero',
                'type'      => 'superadmin',
                'vendor_id' => 0,
                'mobile'    => '082233527616',
                'email'     => 'admin@admin.com',
                'password'  => '$2a$12$xvkjSScUPRexfcJTAy9ATutIeGUuRgJrjDIdL/.xlrddEvRZINpeC',
                'image'     => ''
            ],
            [
                'id'        => 2,
                'name'      => 'Reza',
                'type'      => 'vendor',
                'vendor_id' => 1,
                'mobile'    => '082233521234',
                'email'     => 'reza@gmail.com',
                'password'  => '$2a$12$xvkjSScUPRexfcJTAy9ATutIeGUuRgJrjDIdL/.xlrddEvRZINpeC',
                'image'     => ''
            ],
        ];

        Admin::insert($adminRecords);
    }
}
