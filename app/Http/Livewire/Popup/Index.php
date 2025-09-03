<?php

namespace App\Http\Livewire\Popup;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Popup;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalPopups;

    public function mount()
    {
        $this->totalPopups = Popup::count();
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
        $this->totalPopups = Popup::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.popup.index', [
            'popups' => Popup::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->latest()->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
