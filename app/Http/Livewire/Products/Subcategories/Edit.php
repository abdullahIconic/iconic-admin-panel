<?php

namespace App\Http\Livewire\Products\SubCategories;

use App\Models\ProductCategory;
use Livewire\Component;
use Str;
use App\Models\ProductSubCategory as SubCategory;

class Edit extends Component
{
    public
        $categories,
        $subcategory,
        $visible,
        $category,
        $title,
        $url,
        $meta_title,
        $description,
        $meta_description,
        $meta_keywords
    ;

    public function mount(SubCategory $subcategory)
    {
        $this->categories = ProductCategory::where('visible', true)->get();

        $this->subcategory = $subcategory;
        $this->visible = $subcategory->visible;
        $this->category = $subcategory->category_id;
        $this->title = $subcategory->title;
        $this->url = $subcategory->url;
        $this->meta_title = $subcategory->meta_title;
        $this->description = $subcategory->description;
        $this->meta_description = $subcategory->meta_description;
        $this->meta_keywords = $subcategory->meta_keywords;
    }

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function update()
    {
        $this->subcategory->update([
            "visible" => $this->visible,
            "category_id" => $this->category,
            "title" => $this->title,
            "url" => $this->url,
            "meta_title" => $this->meta_title,
            "description" => $this->description,
            "meta_description" => $this->meta_description,
            "meta_keywords" => $this->meta_keywords,
            "updated_by" => auth()->id(),
            "updated_at" => now(),
        ]);

        return redirect(route('products.subcategories.index'));
    }

    public function render()
    {
        return view('livewire.products.subcategories.edit')->extends('layouts.panel');
    }
}
