<?php

namespace App\Http\Livewire\ServiceLps\Material;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\LpsMaterial;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalMaterials;

    public function mount()
    {
        $this->totalMaterials = LpsMaterial::count();
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
        $this->totalMaterials = LpsMaterial::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.serviceLps.material.index', [
            'materials' => LpsMaterial::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
