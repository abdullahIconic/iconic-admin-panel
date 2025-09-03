<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    public function services()
    {
        return $this->hasMany(Service::class, 'category_id');
    }

    public function subcategories()
    {
        return $this->hasMany(ServiceSubCategory::class, 'category_id');
    }

    public function feature_images()
    {
        return $this->hasMany(BestFeatureImage::class, 'page');
    }
}
