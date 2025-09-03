<?php

namespace App\Http\Livewire\Products\Brands;

use Livewire\Component;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $brand;

    public function mount(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function delete()
    {
        Storage::delete($this->brand->image);
        Storage::delete($this->brand->image_medium);
        Storage::delete($this->brand->image_small);
        $this->brand->delete();
        return redirect(route('products.brands.index'));
    }

    public function render()
    {
        return view('livewire.products.brands.show')->extends('layouts.panel');
    }
}
