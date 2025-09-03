<?php

namespace App\Http\Livewire\Products\Branches;

use App\Models\Brand;
use Livewire\Component;
use Str;
use App\Models\BrandBranch as Branch;

class Create extends Component
{
    public
        $brands,
        $visible = 1,
        $brand,
        $title,
        $url,
        $meta_title,
        $description,
        $meta_description,
        $meta_keywords
    ;

    public function mount()
    {
        $this->brands = Brand::where('visible', true)->get();
    }

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function store()
    {
        Branch::create([
            "visible" => $this->visible,
            "brand_id" => $this->brand,
            "title" => $this->title,
            "url" => $this->url,
            "meta_title" => $this->meta_title,
            "meta_description" => $this->meta_description,
            "meta_keywords" => $this->meta_keywords,
            "created_by" => auth()->id(),
            "created_at" => now(),
        ]);

        return redirect(route('products.branches.index'));
    }

    public function render()
    {
        return view('livewire.products.branches.create')->extends('layouts.panel');
    }
}