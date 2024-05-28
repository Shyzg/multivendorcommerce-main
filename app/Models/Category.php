<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id')->select('id', 'name');
    }

    public static function categoryDetails($url)
    {
        $categoryDetails = Category::select('id', 'category_name', 'url', 'description')->where('url', $url)->first()->toArray();
        $catIds[] = $categoryDetails['id'];

        $breadcrumbs = '
                <li class="is-marked"><a href="' . url($categoryDetails['url']) . '">' . $categoryDetails['category_name'] . '</a></li>';

        $resp = array(
            'catIds'          => $catIds,
            'categoryDetails' => $categoryDetails,
            'breadcrumbs'     => $breadcrumbs
        );

        return $resp;
    }

    public static function getCategoryName($category_id)
    {
        $getCategoryName = Category::select('category_name')->where('id', $category_id)->first();

        return $getCategoryName->category_name ?? null;
    }
}
