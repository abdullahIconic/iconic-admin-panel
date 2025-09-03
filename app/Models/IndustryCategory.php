<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    public function industries()
    {
        return $this->hasMany(Industry::class, 'category_id');
    }

    public function feature_images()
    {
        return $this->hasMany(BestFeatureImage::class, 'page');
    }
}
