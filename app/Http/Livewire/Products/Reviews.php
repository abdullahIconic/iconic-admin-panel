<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Review;

class Reviews extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 50;
    public $keyword = '';
    public $totalReviews;

    public function mount()
    {
        $this->totalReviews = Review::count();
    }

    public function updatingQty()
    {
        $this->resetPage();
    }

    public function updatingKeyword()
    {
        $this->resetPage();
    }

    public function toggleStatus($id)
    {
        $review = Review::find($id);
        $review->status = $review->status == 1 ? 0 : 1;
        $review->save();
    }

    public function render()
    {
        $this->totalReviews = Review::where(function ($query) {
            $query->where('comment', 'like', '%'.$this->keyword.'%')
                  ->orWhere('email', 'like', '%'.$this->keyword.'%');
        })->latest()->count();

        return view('livewire.products.review', [
            'reviews' => Review::where(function ($query) {
                $query->where('comment', 'like', '%'.$this->keyword.'%')
                      ->orWhere('email', 'like', '%'.$this->keyword.'%');
            })
            ->latest()
            ->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
