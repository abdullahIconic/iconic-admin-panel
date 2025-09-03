<?php

namespace App\Http\Livewire\Solutions;

use Livewire\Component;
use App\Models\Solution;

class Show extends Component
{
    public $solution;

    public function mount(Solution $solution)
    {
        $this->solution = $solution;
    }

    public function render()
    {
        return view('livewire.solutions.show')->extends('layouts.panel');
    }
}
