<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    public function categories()
    {
      return  $this->belongsToMany(Category::class,'brand_categories')
            ->withPivot('brand_id','category_id')
            ->withTimestamps();
    }
}
