<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends=['photo'];

    public function getPhotoAttribute()
    {
    	if(!is_null($this->attributes['image']))
    		$photo=asset('storage/'.$this->attributes['image']);
    	elseif(!is_null($this->attributes['image_medium']))
    		$photo=asset('storage/'.$this->attributes['image_medium']);
    	elseif(!is_null($this->attributes['image_small']))
    		$photo=asset('storage/'.$this->attributes['image_small']);
    	else
    		$photo='';

    	return $photo;
    }
}
