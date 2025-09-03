<?php

namespace App\Http\Livewire\Offers;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Offer;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalOffers;

    public function mount()
    {
        $this->totalOffers = Offer::count();
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
        $this->totalOffers = Offer::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.offers.index', [
            'offers' => Offer::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->latest()->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
