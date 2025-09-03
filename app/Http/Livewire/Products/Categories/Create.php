<?php

namespace App\Http\Livewire\Products\Categories;

use Livewire\Component;
use Str;
use App\Models\ProductCategory as Category;

class Create extends Component
{
    public
        $visible = 1,
        $title,
        $url,
        $meta_title,
        $description,
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
            "meta_title" => $this->meta_title,
            "description" => $this->description,
            "meta_description" => $this->meta_description,
            "meta_keywords" => $this->meta_keywords,
            "created_by" => auth()->id(),
            "created_at" => now(),
        ]);

        return redirect(route('products.categories.index'));
    }

    public function render()
    {
        return view('livewire.products.categories.create')->extends('layouts.panel');
    }
}