<?php

namespace App\Http\Livewire\Products\Categories;

use Livewire\Component;
use App\Models\ProductCategory as Category;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $category;

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function delete()
    {
        Storage::delete($this->category->image);
        Storage::delete($this->category->image_medium);
        Storage::delete($this->category->image_small);
        $this->category->delete();
        return redirect(route('products.categories.index'));
    }

    public function render()
    {
        return view('livewire.products.categories.show')->extends('layouts.panel');
    }
}
