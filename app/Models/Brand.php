<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function branches()
    {
        return $this->hasMany(BrandBranch::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function categories()
    {
        return $this->belongsToMany(
            ProductCategory::class,
            'brand_categories',
            'brand_id',
            'category_id'
        );
    }
}
