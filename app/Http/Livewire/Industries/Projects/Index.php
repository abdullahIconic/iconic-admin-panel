<?php

namespace App\Http\Livewire\Industries\Projects;

use App\Models\IndustryProject;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $qty = 12;
    public $keyword = '';
    public $totalIndustryProjects;

    public function mount()
    {
        $this->totalIndustryProjects = IndustryProject::count();
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
        $this->totalIndustryProjects = IndustryProject::where(function ($query) {
            $query->where('title', 'like', '%'.$this->keyword.'%');
        })->count();

        return view('livewire.industries.industry-projects.index', [
            'projects' => IndustryProject::with('industry:id,title')->where(function ($query) {
                $query->where('title', 'like', '%'.$this->keyword.'%');
            })->paginate($this->qty)
        ])->extends('layouts.panel');
    }
}
