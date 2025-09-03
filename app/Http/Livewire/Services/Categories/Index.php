<?php

namespace App\Http\Livewire\Services\Categories;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ServiceCategory as Category;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalCategories;

    public function mount()
    {
        $this->totalCategories = Category::count();
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
        $this->totalCategories = Category::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.services.categories.index', [
            'categories' => Category::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%')
                      ->where('type', 'service');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
