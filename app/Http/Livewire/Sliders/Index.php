<?php

namespace App\Http\Livewire\Sliders;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Slider;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalPosts;

    public function mount()
    {
        $this->totalPosts = Slider::count();
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
        $this->totalPosts = Slider::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.sliders.index', [
            'sliders' => Slider::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->latest()->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
