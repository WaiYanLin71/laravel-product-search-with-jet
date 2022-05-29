<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function brandCategory()
    {
       return $this->belongsTo(BrandCategory::class,'brand_category_id',);
    }

    public function Status()
    {
        $this->belongsTo(Status::class);
    }
}
