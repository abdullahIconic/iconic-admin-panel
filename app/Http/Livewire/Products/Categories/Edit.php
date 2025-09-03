<?php

namespace App\Http\Livewire\Products\Categories;

use Livewire\Component;
use Str;
use App\Models\ProductCategory as Category;

class Edit extends Component
{
    public
        $category,
        $visible,
        $title,
        $url,
        $meta_title,
        $description,
        $meta_description,
        $meta_keywords
    ;

    public function mount(Category $category)
    {
        // Product Data
        $this->category = $category;
        $this->visible = $category->visible;
        $this->title = $category->title;
        $this->url = $category->url;
        $this->meta_title = $category->meta_title;
        $this->description = $category->description;
        $this->meta_description = $category->meta_description;
        $this->meta_keywords = $category->meta_keywords;
    }

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function update()
    {
        $this->category->update([
            "visible" => $this->visible,
            "title" => $this->title,
            "url" => $this->url,
            "meta_title" => $this->meta_title,
            "description" => $this->description,
            "meta_description" => $this->meta_description,
            "meta_keywords" => $this->meta_keywords,
            "updated_by" => auth()->id(),
            "updated_at" => now(),
        ]);

        return redirect(route('products.categories.index'));
    }

    public function render()
    {
        return view('livewire.products.categories.edit')->extends('layouts.panel');
    }
}
