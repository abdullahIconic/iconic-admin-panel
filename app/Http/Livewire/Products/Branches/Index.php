<?php

namespace App\Http\Livewire\Products\Branches;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\BrandBranch as Branch;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalBranches;

    public function mount()
    {
        $this->totalBranches = Branch::count();
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
        $this->totalBranches = Branch::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.products.branches.index', [
            'branches' => Branch::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
