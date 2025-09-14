<?php

namespace App\Http\Livewire\Services\Subcategories;

use Livewire\Component;
use Str;
use App\Models\ServiceSubcategory as Subcategory;
use App\Models\ServiceCategory as Category;

class Create extends Component
{
     public
        $visible = 1,
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
         $this->categories = Category::where('visible', 1)->where('type', 'service')->get();
    }

    public function updatedTitle()
    {
        $this->url = Str::slug($this->title);
    }

    public function render()
    {
        return view('livewire.services.subcategories.create')->extends('layouts.panel');
    }
}
