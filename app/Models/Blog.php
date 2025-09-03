<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];

    function author()
    {
        return $this->belongsTo(Team::class, 'authored_by');
    }

    function comments()
    {
        return $this->hasMany(Comment::class);
    }

    function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
}
