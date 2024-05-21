<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
            [
                'id'                => 1,
                'parent_id'         => 0,
                'section_id'        => 1,
                'category_name'     => 'Men',
                'category_image'    => '',
                'category_discount' => 0,
                'description'       => '',
                'url'               => 'men',
            ],
            [
                'id'                => 2,
                'parent_id'         => 0,
                'section_id'        => 1,
                'category_name'     => 'Women',
                'category_image'    => '',
                'category_discount' => 0,
                'description'       => '',
                'url'               => 'women',
            ],
            [
                'id'                => 3,
                'parent_id'         => 0,
                'section_id'        => 1,
                'category_name'     => 'Kids',
                'category_image'    => '',
                'category_discount' => 0,
                'description'       => '',
                'url'               => 'kids',
            ],
        ];

        \App\Models\Category::insert($categoryRecords);
    }
}
