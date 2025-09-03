<?php

namespace App\Http\Livewire\Products\Brands;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Brand;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalBrands;

    public function mount()
    {
        $this->totalBrands = Brand::count();
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
        $this->totalBrands = Brand::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.products.brands.index', [
            'brands' => Brand::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
