<?php

namespace App\Http\Livewire\GrowthPaths;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Client;
use App\Models\GrowthPath;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 20;
    public $keyword = '';
    public $totalClients;

    public function mount()
    {
        $this->totalClients = GrowthPath::count();
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
        $this->totalClients = GrowthPath::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.growthpath.index', [
            'growthpaths' => GrowthPath::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->orderByDesc('id')->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
