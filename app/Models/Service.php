<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
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
}
