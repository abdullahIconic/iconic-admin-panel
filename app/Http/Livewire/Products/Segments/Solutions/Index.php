<?php

namespace App\Http\Livewire\Products\Segments\Solutions;

use App\Models\IndustrySolution;
use App\Models\SegmentSolution;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalSegmentSolutions;

    public function mount()
    {
        $this->totalSegmentSolutions = SegmentSolution::count();
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
        $this->totalSegmentSolutions = SegmentSolution::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.products.segments.segment-solutions.index', [
            'solutions' => SegmentSolution::with('product_segment:id,title')->where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
