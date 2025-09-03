<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use Str;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductCategory as Category;

class Edit extends Component
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
        $subcategory,
        $overview,
        $features,
        $specifications,
        $includes,
        $accesories
    ;

    public
        $product,
        $brands,
        $branches,
        $categories,
        $subcategories
    ;

    public function mount(Product $product)
    {
        $this->product_id = $product->id;
        $this->visible = $product->visible;
        $this->featured = $product->featured;
        $this->title = $product->title;
        $this->url = $product->url;

        $this->price = $product->price;
        $this->regular_price = $product->regular_price;
        $this->quantity = $product->quantity;
        $this->short_description = $product->short_description;
        $this->meta_title = $product->meta_title;
        $this->meta_description = $product->meta_description;
        $this->meta_keywords = $product->meta_keywords;
        $this->brand = $product->brand_id;
        $this->branch = $product->branch_id;
        $this->category = $product->category_id;
        $this->subcategory = $product->subcategory_id;
        $this->overview = $product->overview;
        $this->features = $product->features;
        $this->specifications = $product->specifications;
        $this->includes = $product->includes;
        $this->accesories = $product->accesories;

        // Other Data
        $this->product = $product;
        $this->brands = Brand::where('visible', 1)->get();

        $brand = $product->brand()->where('visible', 1)->firstOrFail();
        $this->branches = $brand->branches()->where('visible', 1)->get();
        $this->categories = $brand->categories()->where('visible', 1)->get();

        $category = $this->product->category()->where('visible', 1)->firstOrFail();
        $this->subcategories = $category->subcategories()->where('visible', 1)->get();

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
        return view('livewire.products.edit')->extends('layouts.panel');
    }
}
