<?php

namespace App\Http\Livewire\Services\Subcategories;

use Livewire\Component;
use Str;
use App\Models\ServiceCategory as Category;
use App\Models\ServiceSubcategory;

class Edit extends Component
{

    public
        $visible,
        $highlighted,
        $category,
        $slogan,
        $title,
        $url,
        $article,
        $meta_title,
        $meta_description,
        $meta_keywords;

    public $subcategory, $categories = [];

    public function mount(ServiceSubcategory $subcategory)
    {
        // Subcategory Data
        $this->visible = $subcategory->visible;
        $this->category = $subcategory->category_id;
        $this->slogan = $subcategory->slogan;
        $this->title = $subcategory->title;
        $this->url = $subcategory->url;
        $this->article = $subcategory->article;
        $this->meta_title = $subcategory->meta_title;
        $this->meta_description = $subcategory->meta_description;
        $this->meta_keywords = $subcategory->meta_keywords;

        // Other Data
        $this->subcategory = $subcategory;
        $this->categories = Category::where('visible', 1)->where('type', 'service')->get();
    }

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function render()
    {
        return view('livewire.services.subcategories.edit')->extends('layouts.panel');
    }
}
