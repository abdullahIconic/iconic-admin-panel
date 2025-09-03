<?php

namespace App\Http\Livewire\SectionData;

use Livewire\Component;
use App\Models\SectionData;

class Edit extends Component
{
    public $section;
    public $page;

    public function mount(SectionData $section)
    {
        $this->section = $section;
        $this->page = $section->page;
    }

    public function render()
    {
        return view('livewire.section-data.edit')->extends('layouts.panel');
    }
}
