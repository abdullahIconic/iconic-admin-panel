<?php

namespace App\Http\Livewire\Products\SubCategories;

use App\Models\ProductCategory;
use Livewire\Component;
use Str;
use App\Models\ProductSubCategory as SubCategory;

class Create extends Component
{
    public
        $categories,
        $visible = 1,
        $category,
        $title,
        $url,
        $meta_title,
        $description,
        $meta_description,
        $meta_keywords
    ;

    public function mount()
    {
        $this->categories = ProductCategory::where('visible', true)->get();
    }

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function store()
    {
        SubCategory::create([
            "visible" => $this->visible,
            "category_id" => $this->category,
            "title" => $this->title,
            "url" => $this->url,
            "meta_title" => $this->meta_title,
            "description" => $this->description,
            "meta_description" => $this->meta_description,
            "meta_keywords" => $this->meta_keywords,
            "created_by" => auth()->id(),
            "created_at" => now(),
        ]);

        return redirect(route('products.subcategories.index'));
    }

    public function render()
    {
        return view('livewire.products.subcategories.create')->extends('layouts.panel');
    }
}