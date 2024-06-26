<?php

namespace Database\Seeders;

use App\Models\Category;
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
                'section_id'        => 1,
                'category_name'     => 'Makanan',
                'category_discount' => 0,
                'url'               => 'makanan',
            ],
            [
                'id'                => 2,
                'section_id'        => 1,
                'category_name'     => 'Minuman',
                'category_discount' => 0,
                'url'               => 'minuman',
            ]
        ];

        Category::insert($categoryRecords);
    }
}
