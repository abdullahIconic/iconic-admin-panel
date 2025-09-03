<?php

namespace App\Http\Livewire\ServiceLps\Card;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\LpsCard;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalCards;

    public function mount()
    {
        $this->totalCards = LpsCard::count();
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
        $this->totalCards = LpsCard::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.serviceLps.card.index', [
            'cards' => LpsCard::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
