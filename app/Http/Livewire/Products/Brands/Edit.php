<?php

namespace App\Http\Livewire\Products\Brands;

use App\Helper\Thumbnail;
use Livewire\Component;
use Str;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public
        $brand,
        $visible,
        $title,
        $url,
        $meta_title,
        $description,
        $meta_description,
        $meta_keywords,
        $image;

    public function mount(Brand $brand)
    {
        // Product Data
        $this->brand = $brand;
        $this->visible = $brand->visible;
        $this->title = $brand->title;
        $this->url = $brand->url;
        $this->meta_title = $brand->meta_title;
        $this->description = $brand->description;
        $this->meta_description = $brand->meta_description;
        $this->meta_keywords = $brand->meta_keywords;
    }

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function update()
    {
        $this->brand->update([
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

        // Checking for sample
        if ($this->image) {

            // Deleting existing image
            Storage::delete($this->brand->image);
            Storage::delete($this->brand->image_medium);
            Storage::delete($this->brand->image_small);

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
            $path = "products/brands/" . $this->brand->url;
            $thumbnail = Thumbnail::make($this->image, $dimension, $path);

            // Updating Image Paths
            $this->brand->update([
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
        return view('livewire.products.brands.edit')->extends('layouts.panel');
    }
}
