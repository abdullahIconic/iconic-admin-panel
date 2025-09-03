<?php

namespace App\Http\Livewire\Products\Segments\Projects;

use App\Models\SegmentProject;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalProductProjects;

    public function mount()
    {
        $this->totalProductProjects = SegmentProject::count();
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
        $this->totalProductProjects = SegmentProject::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.products.segments.segment-projects.index', [
            'projects' => SegmentProject::with('product_segment:id,title')->where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
