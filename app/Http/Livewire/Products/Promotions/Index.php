<?php

namespace App\Http\Livewire\Products\Promotions;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ProductPromotion;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalPromotions;

    public function mount()
    {
        $this->totalPromotions = ProductPromotion::count();
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
        $this->totalPromotions = ProductPromotion::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.products.promotions.index', [
            'promotions' => ProductPromotion::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
