<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    // Satu 'section' memiliki banyak 'categories'
    public function categories()
    {
        // Foreign key 'section_id' didalam table `categories`
        return $this->hasMany(Category::class, 'section_id');
    }

    public static function sections()
    {
        $getSections = Section::with('categories')->get();

        return $getSections;
    }
}
