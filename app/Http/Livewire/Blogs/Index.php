<?php

namespace App\Http\Livewire\Blogs;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Blog;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalPosts;

    public function mount()
    {
        $this->totalPosts = Blog::count();
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
        $this->totalPosts = Blog::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.blogs.index', [
            'blogs' => Blog::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->latest()->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
