<?php

namespace App\Http\Livewire\Services\Categories;

use Livewire\Component;
use Str;
use App\Models\ServiceCategory as Category;

class Edit extends Component
{
    public
        $category,
        $visible,
        $slogan,
        $title,
        $url,
        $description,
        $meta_title,
        $meta_description,
        $meta_keywords
    ;

    public function mount(Category $category)
    {
        // Category Data
        $this->category = $category;
        $this->visible = $category->visible;
        $this->slogan = $category->slogan;
        $this->title = $category->title;
        $this->url = $category->url;
        $this->description = $category->description;
        $this->meta_title = $category->meta_title;
        $this->meta_description = $category->meta_description;
        $this->meta_keywords = $category->meta_keywords;
    }

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function render()
    {
        return view('livewire.services.categories.edit')->extends('layouts.panel');
    }
}
