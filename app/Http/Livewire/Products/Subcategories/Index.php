<?php

namespace App\Http\Livewire\Products\SubCategories;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ProductSubCategory as SubCategory;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalSubcategories;

    public function mount()
    {
        $this->totalSubcategories = SubCategory::count();
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
        $this->totalSubcategories = SubCategory::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.products.subcategories.index', [
            'subcategories' => SubCategory::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
