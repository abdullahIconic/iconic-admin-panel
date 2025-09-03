<?php

namespace App\Http\Livewire\Services\Rental\Tab;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\RentalTab;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalTabs;

    public function mount()
    {
        $this->totalTabs = RentalTab::count();
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
        $this->totalTabs = RentalTab::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.services.rental.tab.index', [
            'tabs' => RentalTab::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
