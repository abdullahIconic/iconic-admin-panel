<?php

namespace App\Http\Livewire\SectionData;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\SectionData;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalSections;

    public function mount()
    {
        $this->totalSections = SectionData::count();
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
        $this->totalSections = SectionData::where(function ($query) {
            $query->where('title', 'like', '%' . $this->keyword . '%');
        })->count();

        return view('livewire.section-data.index', [
            'sections' => SectionData::where(function ($query) {
                $query->where('title', 'like', '%' . $this->keyword . '%');
            })->orWhere(function ($query) {
                $query->where('page', 'like', '%' . $this->keyword . '%');
            })
                ->latest()
                ->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
