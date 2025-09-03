<?php

namespace App\Http\Livewire\ServiceCarousel;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ServiceCarousel;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $carousel_for = '';
    public $keyword = '';
    public $totalCarousels;

    public function mount()
    {
        $this->totalCarousels = ServiceCarousel::count();
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
        $this->totalCarousels = ServiceCarousel::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.service-carousel.index', [
            'carousels' => ServiceCarousel::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->where(function ($query) {
                if($this->carousel_for){
                    $query->where('carousel_for', $this->carousel_for);
                }
            })
            ->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
