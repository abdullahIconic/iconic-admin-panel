<?php

namespace App\Http\Livewire\Blogs\Categories;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\BlogCategory as Category;

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

        return view('livewire.blogs.categories.index', [
            'categories' => Category::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
