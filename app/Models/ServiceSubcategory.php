<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSubcategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    function author()
    {
        return $this->belongsTo(User::class);
    }

    function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'sub_category_id')->where('visible', 1);
    }
}
