<?php

namespace App\Http\Livewire\Products\Brands;

use App\Helper\Thumbnail;
use Livewire\Component;
use Str;
use App\Models\Brand;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public
        $visible = 1,
        $title,
        $url,
        $meta_title,
        $description,
        $meta_description,
        $meta_keywords,
        $image;

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function store()
    {
        $brand = Brand::create([
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

        // Checking for sample
        if ($this->image) {

            // Thumbnail Maker
            $dimension = [
                'medium' => [
                    'width' => 320,
                    'height' => 180,
                ],
                'small' => [
                    'width' => 240,
                    'height' => 135,
                ]
            ];
            $path = "products/brands/" . $brand->url;
            $thumbnail = Thumbnail::make($this->image, $dimension, $path);

            // Updating Image Paths
            $brand->update([
                "image" => $thumbnail['image'],
                "image_medium" => $thumbnail['image_medium'],
                "image_small" => $thumbnail['image_small'],
                "updated_by" => auth()->id(),
                "updated_at" => now(),
            ]);
        }

        return redirect(route('products.brands.index'));
    }

    public function render()
    {
        return view('livewire.products.brands.create')->extends('layouts.panel');
    }
}
