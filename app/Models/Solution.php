<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    protected $guarded = [];

    function author()
    {
        return $this->belongsTo(User::class);
    }

    function category()
    {
        return $this->belongsTo(SolutionCategory::class, 'category_id');
    }
}
