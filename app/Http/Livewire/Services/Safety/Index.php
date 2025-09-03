<?php

namespace App\Http\Livewire\Services\Safety;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ServiceSafety;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalSafeties;

    public function mount()
    {
        $this->totalSafeties = ServiceSafety::count();
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
        $this->totalSafeties = ServiceSafety::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.services.safety.index', [
            'safeties' => ServiceSafety::where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
