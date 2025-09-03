<?php

namespace App\Http\Livewire\Products\Segments;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ProductSegment as Segment;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalSegments;

    public function mount()
    {
        $this->totalSegments = Segment::count();
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
        $this->totalSegments = Segment::where(function ($query) {
            $query->where('title', 'like', '%' . $this->keyword . '%');
        })->count();

        return view('livewire.products.segments.index', [
            'segments' => Segment::where(function ($query) {
                $query->where('title', 'like', '%' . $this->keyword . '%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
