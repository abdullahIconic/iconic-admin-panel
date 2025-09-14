<?php

namespace App\Http\Livewire\GrowthPaths;

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.growthpath.create')->extends('layouts.panel');
    }
}
