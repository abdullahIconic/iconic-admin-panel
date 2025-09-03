<?php

namespace App\Http\Livewire\Solutions\Categories;

use Livewire\Component;
use Str;
use App\Models\SolutionCategory as Category;

class Edit extends Component
{
    public
        $category,
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
        $this->title = $category->title;
        $this->url = $category->url;
        $this->description = $category->description;
        $this->meta_title = $category->meta_title;
        $this->meta_description = $category->meta_description;
        $this->meta_keyword = $category->meta_keywordss;
    }

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function render()
    {
        return view('livewire.solutions.categories.edit')->extends('layouts.panel');
    }
}
