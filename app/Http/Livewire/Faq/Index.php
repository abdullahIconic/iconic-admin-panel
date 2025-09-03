<?php

namespace App\Http\Livewire\Faq;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Faq;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $faq_for = '';
    public $keyword = '';
    public $totalFaqs;

    public function mount()
    {
        $this->totalFaqs = Faq::count();
    }

    public function updatingQty()
    {
        $this->resetPage();
    }

    public function updatingKeyword()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        Faq::find($id)->delete();
        return redirect(route('faq.index'));
    }

    public function render()
    {
        $this->totalFaqs = Faq::where(function ($query) {
            $query->where('question', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.faq.index', [
            'faqs' => Faq::where(function ($query) {
                $query->where('question', 'like', '%'.$this->keyword.'%');
            })
            ->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
