<?php

namespace App\Http\Livewire\Industries\Categories;

use Livewire\Component;
use Str;
use App\Models\ServiceCategory as Category;

class Edit extends Component
{
    public
        $category,
        $slogan,
        $title,
        $url,
        $description,
        $overview,
        $solution_overview,
        $project_overview,
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
        $this->overview = $category->overview;
        $this->solution_overview = $category->solution_overview;
        $this->project_overview = $category->project_overview;
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
        return view('livewire.industries.categories.edit')->extends('layouts.panel');
    }
}
