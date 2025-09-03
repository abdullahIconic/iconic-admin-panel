<?php

namespace App\Http\Livewire\Products\Branches;

use App\Models\Brand;
use Livewire\Component;
use Str;
use App\Models\BrandBranch as Branch;

class Edit extends Component
{
    public
        $brands,
        $branch,
        $visible,
        $brand,
        $title,
        $url,
        $meta_title,
        $description,
        $meta_description,
        $meta_keywords
    ;

    public function mount(Branch $branch)
    {
        $this->brands = Brand::where('visible', true)->get();

        $this->branch = $branch;
        $this->visible = $branch->visible;
        $this->brand = $branch->brand_id;
        $this->title = $branch->title;
        $this->url = $branch->url;
        $this->meta_title = $branch->meta_title;
        $this->meta_description = $branch->meta_description;
        $this->meta_keywords = $branch->meta_keywords;
    }

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function update()
    {
        $this->branch->update([
            "visible" => $this->visible,
            "brand_id" => $this->brand,
            "title" => $this->title,
            "url" => $this->url,
            "meta_title" => $this->meta_title,
            "description" => $this->description,
            "meta_description" => $this->meta_description,
            "meta_keywords" => $this->meta_keywords,
            "updated_by" => auth()->id(),
            "updated_at" => now(),
        ]);

        return redirect(route('products.branches.index'));
    }

    public function render()
    {
        return view('livewire.products.branches.edit')->extends('layouts.panel');
    }
}
