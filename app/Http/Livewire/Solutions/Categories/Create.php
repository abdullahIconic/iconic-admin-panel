<?php

namespace App\Http\Livewire\Solutions\Categories;

use Livewire\Component;
use Str;
use App\Models\SolutionCategory as Category;

class Create extends Component
{
    public
        $visible = 1,
        $title,
        $url,
        $description,
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
            "title" => $this->title,
            "url" => $this->url,
            "description" => $this->description,
            "meta_title" => $this->meta_title,
            "meta_description" => $this->meta_description,
            "meta_keywords" => $this->meta_keywords
        ]);
    }

    public function render()
    {
        return view('livewire.solutions.categories.create')->extends('layouts.panel');
    }
}