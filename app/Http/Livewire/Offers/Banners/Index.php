<?php

namespace App\Http\Livewire\Offers\Banners;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\OfferBanner;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalBanners;

    public function mount()
    {
        $this->totalBanners = OfferBanner::count();
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
        $this->totalBanners = OfferBanner::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.offers.banners.index', [
            'banners' => OfferBanner::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
