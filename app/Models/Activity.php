<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $guarded = [];

    function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    function category()
    {
        return $this->belongsTo(ActivityCategory::class);
    }
}
