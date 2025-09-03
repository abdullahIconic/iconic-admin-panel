<?php

namespace App\Http\Livewire\Contests;

use Livewire\Component;
use Str;
use App\Models\Contest;

class Create extends Component
{
    public function render()
    {
        return view('livewire.contests.create')->extends('layouts.panel');
    }
}