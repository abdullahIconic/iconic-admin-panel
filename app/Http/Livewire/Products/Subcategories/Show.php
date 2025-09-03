<?php

namespace App\Http\Livewire\Products\SubCategories;

use Livewire\Component;
use App\Models\ProductCategory as SubCategory;
use Storage;

class Show extends Component
{
    public $subcategory;

    public function mount(SubCategory $subcategory)
    {
        $this->subcategory = $subcategory;
    }

    public function delete()
    {
        $this->subcategory->delete();
        return redirect(route('products.subcategories.index'));
    }

    public function render()
    {
        return view('livewire.products.subcategories.show')->extends('layouts.panel');
    }
}
