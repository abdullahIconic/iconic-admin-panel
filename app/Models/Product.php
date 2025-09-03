<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function branch()
    {
        return $this->belongsTo(BrandBranch::class, 'branch_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(ProductSubCategory::class, 'sub_category_id');
    }

    public function resources()
    {
      return $this->hasMany(ProductResource::class, 'product_id');
    }

    public function images()
    {
      return $this->hasMany(ProductImage::class);
    }

    public function reviews()
    {
      return $this->hasMany(Review::class);
    }
}
