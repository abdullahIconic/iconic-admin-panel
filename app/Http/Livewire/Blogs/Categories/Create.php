<?php

namespace App\Http\Livewire\Blogs\Categories;

use Livewire\Component;
use Str;
use App\Models\BlogCategory as Category;

class Create extends Component
{
    public
        $visible = 1,
        $language = 'en',
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
            "language" => $this->language,
            "title" => $this->title,
            "url" => $this->url,
            "description" => $this->description,
            "meta_title" => $this->meta_title,
            "meta_description" => $this->meta_description,
            "meta_keywords" => $this->meta_keywords,
            "created_by" => auth()->id(),
            "created_at" => now(),
        ]);

        return redirect(route('blogs.categories.index'));
    }

    public function render()
    {
        return view('livewire.blogs.categories.create')->extends('layouts.panel');
    }
}