<?php

namespace App\Http\Livewire\Products\Brands;

use Livewire\Component;
use App\Models\Brand;
use App\Models\ProductCategory;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $brand;
    public $qty = 12;
    public $keyword = '';

    public function mount(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function attach($category)
    {
        $this->brand->categories()->attach($category);
    }

    public function detach($category)
    {
        $this->brand->categories()->detach($category);
    }

    public function updatingQty()
    {
        $this->resetPage();
    }

    public function updatingKeyword()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.products.brands.categories', [
            'categories' => ProductCategory::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->where('visible', true)->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
