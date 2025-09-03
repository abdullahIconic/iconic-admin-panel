<?php

namespace App\Http\Livewire\Products\Segments\Categories;

use Livewire\Component;
use Str;
use App\Models\ServiceCategory as Category;

class Create extends Component
{
    public
        $visible = 1,
        $language,
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

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function store()
    {
        Category::create([
            "visible" => $this->visible,
            "slogan" => $this->slogan,
            "title" => $this->title,
            "url" => $this->url,
            "description" => $this->description,
            "overview" => 'segment',
            "solution_overview" => $this->solution_overview,
            "project_overview" => $this->project_overview,
            "meta_title" => $this->meta_title,
            "meta_description" => $this->meta_description,
            "meta_keywords" => $this->meta_keywords,
            "type" => 'segment'
        ]);
    }

    public function render()
    {
        return view('livewire.products.segments.categories.create')->extends('layouts.panel');
    }
}