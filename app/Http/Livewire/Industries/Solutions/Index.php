<?php

namespace App\Http\Livewire\Industries\Solutions;

use App\Models\IndustrySolution;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalIndustrysolutions;

    public function mount()
    {
        $this->totalIndustrysolutions = IndustrySolution::count();
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
        $this->totalIndustrysolutions = IndustrySolution::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.industries.industry-solutions.index', [
            'solutions' => IndustrySolution::with('industry:id,title')->where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
