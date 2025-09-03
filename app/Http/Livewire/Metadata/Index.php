<?php

namespace App\Http\Livewire\Metadata;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Metadata;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalData;

    public function mount()
    {
        $this->totalData = Metadata::count();
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
        $this->totalData = Metadata::where(function ($query) {
            $query->where('page_name', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.metadata.index', [
            'metadata' => Metadata::where(function ($query) {
                $query->where('page_name', 'like', '%'.$this->keyword.'%');
            })->orderBy('id', 'desc')->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
