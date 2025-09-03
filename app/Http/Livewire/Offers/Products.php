<?php

namespace App\Http\Livewire\Offers;

use Livewire\Component;
use App\Models\Offer;
use App\Models\Product;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $offer;
    public $qty = 12;
    public $keyword = '';

    public function mount(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function attach($product)
    {
        $this->offer->products()->attach($product);
    }

    public function detach($product)
    {
        $this->offer->products()->detach($product);
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
        return view('livewire.offers.products', [
            'products' => Product::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->where('visible', true)->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
