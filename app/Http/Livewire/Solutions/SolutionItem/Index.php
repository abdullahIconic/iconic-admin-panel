<?php

namespace App\Http\Livewire\Solutions\SolutionItem;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\SolutionItem;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalSolutions;

    public function mount()
    {
        $this->totalSolutions = SolutionItem::count();
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
        $this->totalSolutions = SolutionItem::where(function ($query) {
            $query->where('title', 'like', '%' . $this->keyword . '%');
        })->count();

        return view('livewire.solutions.solutionItem.index', [
            'solutions' => SolutionItem::where(function ($query) {
                $query->where('title', 'like', '%' . $this->keyword . '%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
