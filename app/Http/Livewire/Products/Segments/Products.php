<?php

namespace App\Http\Livewire\Products\Segments;

use App\Models\Product;
use Livewire\Component;
use App\Models\ProductSegment as Segment;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $segment;
    public $qty = 12;
    public $keyword = '';

    public function mount(Segment $segment)
    {
        $this->segment = $segment;
    }

    public function attach($product)
    {
        $this->segment->products()->attach($product);
    }

    public function detach($product)
    {
        $this->segment->products()->detach($product);
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
        return view('livewire.products.segments.products', [
            'products' => Product::where(function ($query) {
                $query->where('title', 'like', '%' . $this->keyword . '%');
            })->where('visible', true)->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
