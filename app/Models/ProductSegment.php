<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSegment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'segment_products',
            'segment_id',
            'product_id'
        );
    }

    public function solutions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            SegmentSolution::class,
            'product_segment_id',
            'id'
        );
    }
    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            SegmentProject::class,
            'product_segment_id',
            'id'
        );
    }
}
