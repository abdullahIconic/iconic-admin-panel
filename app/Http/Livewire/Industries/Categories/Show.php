<?php

namespace App\Http\Livewire\Industries\Categories;

use App\Models\BestFeatureImage;
use Livewire\Component;
use App\Models\ServiceCategory as Category;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $category;
    public $feature_images;

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->feature_images = $category->feature_images()->get();
    }

    public function delete()
    {
        Storage::delete($this->category->image);
        Storage::delete($this->category->image_medium);
        Storage::delete($this->category->image_small);

        $this->category->delete();

        return redirect(route('industries.categories.index'));
    }

    public function featureImageToggle($imageId)
    {
        $image = BestFeatureImage::find($imageId);
        $image->update([
            "visible" => !$image->visible
        ]);

        return redirect(route('industries.categories.show', $this->category->id));
    }

    public function featureImageDelete($imageId)
    {
        $image = BestFeatureImage::find($imageId);

        Storage::delete($image->image);
        Storage::delete($image->image_medium);
        Storage::delete($image->image_small);

        $image->delete();
        
        return redirect(route('industries.categories.show', $this->category->id));
    }

    public function render()
    {
        return view('livewire.industries.categories.show')->extends('layouts.panel');
    }
}
