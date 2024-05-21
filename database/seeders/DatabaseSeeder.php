<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProductsFilter;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsTableSeeder::class);
        $this->call(VendorsTableSeeder::class);
        $this->call(VendorsBusinessDetailsTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductsAttributesTableSeeder::class);
        $this->call(FiltersTableSeeder::class);
        $this->call(FiltersValuesTableSeeder::class);
        $this->call(CouponsTableSeeder::class);
        $this->call(DeliveryAddressTableSeeder::class);
        $this->call(OrderStatusTableSeeder::class);
        $this->call(OrderItemStatusTableSeeder::class);
        $this->call(RatingsTableSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(ShippingChargeSeeder::class);
    }
}
