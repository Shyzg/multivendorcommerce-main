<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Product;

class ProductsFilter extends Model
{
    use HasFactory;



    // this method is called in admin\filters\filters_values.blade.php to be able to translate the `filter_id` column to filter names to show them in the table in filters_values.blade.php in the Admin Panel    
    public static function getFilterName($filter_id)
    {
        $getFilterName = ProductsFilter::select('filter_name')->where('id', $filter_id)->first();


        return $getFilterName->filter_name;
    }



    // Every Product Dynamic Filter has many Product Filter Values (hasMany) (A 'RAM' product dynamic filter has many values like: 4GB, 6GB, 8GB, ...)    
    public function filter_values()
    {
        return $this->hasMany('App\Models\ProductsFiltersValue', 'filter_id'); // 'filter_id' is the foreign key
    }



    // Get all the (enabled/active) Filters
    public static function productFilters()
    {
        $productFilters = ProductsFilter::with('filter_values')->where('status', 1)->get()->toArray(); // with('filter_values') is the relationship method name to get the values of a filter

        return $productFilters;
    }



    // Check if a specific filter has a said category    // Get the category related filters (to be able to get a some category filters to view them in filters.blade.php)    
    public static function filterAvailable($filter_id, $category_id)
    {
        $filterAvailable = ProductsFilter::select('cat_ids')->where([
            'id'     => $filter_id,
            'status' => 1
        ])->first()->toArray();

        $catIdsArray = explode(',', $filterAvailable['cat_ids']); // convert the string `cat_ids` column of the `products_filters` database table to an array


        if (in_array($category_id, $catIdsArray)) {
            $available = 'Yes';
        } else {
            $available = 'No';
        }

        return $available;
    }

    public static function getSizes($url)
    {
        $categoryDetails = Category::categoryDetails($url);
        $getProductIds = Product::select('id')->whereIn('category_id', $categoryDetails['catIds'])->pluck('id')->toArray();
        $getProductSizes = \App\Models\ProductsAttribute::select('size')->whereIn('product_id', $getProductIds)->groupBy('size')->pluck('size')->toArray();

        return $getProductSizes;
    }
}
