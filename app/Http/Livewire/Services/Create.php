<?php

namespace App\Http\Livewire\Services;

use Livewire\Component;
use Str;
use App\Models\Service;
use App\Models\ServiceCategory as Category;
use App\Models\ServiceSubcategory as SubCategory;

class Create extends Component
{
    public
        $visible = 1,
        $category,
        $subcategory,
        $title,
        $url,
        $article,
        $meta_title,
        $meta_description,
        $meta_keywords
    ;

    public $categories, $subcategories = [];

     public function mount()
    {
        $this->categories = Category::where('visible', 1)->where('type', 'service')->get();
        $this->subcategories = [];
    }

    public function updatedCategory($categoryId)
    {
        $this->subcategories = SubCategory::where('visible', 1)
                                ->where('category_id', $categoryId)
                                ->get();

        $this->subcategory = null;
    }


    public function updatedTitle()
    {
        $this->url = Str::slug($this->title);
    }

    public function render()
    {
        return view('livewire.services.create')->extends('layouts.panel');
    }
}
