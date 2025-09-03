<?php

namespace App\Http\Livewire\Solutions\Timeline;

use App\Models\SolutionTimeline;
use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.solutions.timeline.create')->extends('layouts.panel');
    }
}