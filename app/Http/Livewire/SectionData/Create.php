<?php

namespace App\Http\Livewire\SectionData;

use Livewire\Component;
use App\Models\SectionData;

class Create extends Component
{
    public function render()
    {
        return view('livewire.section-data.create')->extends('layouts.panel');
    }
}