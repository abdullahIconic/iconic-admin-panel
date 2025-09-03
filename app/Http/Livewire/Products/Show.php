<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function delete()
    {
        Storage::delete($this->product->image);
        Storage::delete($this->product->image_medium);
        Storage::delete($this->product->image_small);

        $this->product->delete();

        return redirect(route('products.index'));
    }

    public function render()
    {
        return view('livewire.products.show')->extends('layouts.panel');
    }
}
