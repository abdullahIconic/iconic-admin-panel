<?php

namespace App\Http\Livewire\Solutions\Timeline;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\SolutionTimeline;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalTimelines;

    public function mount()
    {
        $this->totalTimelines = SolutionTimeline::count();
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
        $this->totalTimelines = SolutionTimeline::where(function ($query) {
            $query->where('title_1', 'like', '%'.$this->keyword.'%')
                ->orWhere('title_2', 'like', '%'.$this->keyword.'%')
                ->orWhere('title_3', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.solutions.timeline.index', [
            'timelines' => SolutionTimeline::where(function ($query) {
                $query->where('title_1', 'like', '%'.$this->keyword.'%')
                    ->orWhere('title_2', 'like', '%'.$this->keyword.'%')
                    ->orWhere('title_3', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
