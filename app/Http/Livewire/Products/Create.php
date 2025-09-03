<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use Str;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductCategory as Category;

class Create extends Component
{
    public
        $visible,
        $featured,
        $title,
        $url,
        $price,
        $regular_price,
        $quantity,
        $short_description,
        $meta_title,
        $meta_description,
        $meta_keywords,
        $brand,
        $branch,
        $category,
        $subcategory
    ;

    public
        $product,
        $brands,
        $branches = [],
        $categories = [],
        $subcategories = []
    ;

    public function mount(Product $product)
    {
        $this->brands = Brand::where('visible', 1)->get();
    }

    public function updatedTitle()
    {
        $this->url = Str::slug($this->title);
    }

    public function updatedBrand()
    {
        $brand = Brand::where('id', $this->brand)->where('visible', 1)->firstOrFail();
        $this->branches = $brand->branches()->where('visible', 1)->get();
        $this->categories = $brand->categories()->where('visible', 1)->get();
    }
    
    public function updatedCategory()
    {
        $category = Category::where('id', $this->category)->where('visible', 1)->firstOrFail();
        $this->subcategories = $category->subcategories()->where('visible', 1)->get();
    }

    public function render()
    {
        return view('livewire.products.create')->extends('layouts.panel');
    }
}