<?php

namespace App\Http\Livewire\Resource\Items;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ResourceItem;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalItems;

    public function mount()
    {
        $this->totalItems = ResourceItem::count();
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
        $this->totalItems = ResourceItem::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.resource.items.index', [
            'items' => ResourceItem::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
