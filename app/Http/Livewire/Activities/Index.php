<?php

namespace App\Http\Livewire\Activities;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Activity;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalPosts;

    public function mount()
    {
        $this->totalPosts = Activity::count();
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
        $this->totalPosts = Activity::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.activities.index', [
            'activities' => Activity::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->latest()->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
