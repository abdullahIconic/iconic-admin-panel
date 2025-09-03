<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function solutions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            IndustrySolution::class,
            'industry_id',
            'id'
        );
    }
    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            IndustryProject::class,
            'industry_id',
            'id'
        );
    }

    function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }
}
