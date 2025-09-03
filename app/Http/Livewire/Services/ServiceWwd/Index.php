<?php

namespace App\Http\Livewire\Services\ServiceWwd;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ServiceWwd;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalWorks;

    public function mount()
    {
        $this->totalWorks = ServiceWwd::count();
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
        $this->totalWorks = ServiceWwd::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.services.serviceWwd.index', [
            'works' => ServiceWwd::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
