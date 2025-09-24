<?php

namespace App\Http\Livewire\Team;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Team;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 20;
    public $keyword = '';
    public $totalMember;

    public function mount()
    {
        $this->totalMember = Team::count();
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
        $this->totalMember = Team::where(function ($query) {
            $query->where('name', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.team.index', [
            'team' => Team::where(function ($query) {
                $query->where('name', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
