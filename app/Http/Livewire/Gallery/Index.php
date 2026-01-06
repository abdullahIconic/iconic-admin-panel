<?php

namespace App\Http\Livewire\Gallery;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Gallery;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 20;
    public $keyword = '';
    public $totalItems;

    public function mount()
    {
        $this->totalItems = Gallery::count();
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
        $this->totalItems = Gallery::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.gallery.index', [
            'galleries' => Gallery::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->orderByDesc('id')->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
