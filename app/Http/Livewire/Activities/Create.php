<?php

namespace App\Http\Livewire\Activities;

use Livewire\Component;
use Str;
use App\Models\Activity;
use App\Models\ActivityCategory as Category;

class Create extends Component
{
    public
        $visible = 1,
        $isFeatured = 1,
        $category,
        $title,
        $url,
        $article,
        $meta_title,
        $meta_description,
        $meta_keywords
    ;
        
    public $categories = [];

    public function mount()
    {
        $this->categories = Category::where('visible', 1)->get();
    }

    public function updatedTitle()
    {
        $this->url = Str::slug($this->title);
    }

    public function render()
    {
        return view('livewire.activities.create')->extends('layouts.panel');
    }
}