<?php

namespace App\Http\Livewire\Contests;

use Livewire\Component;
use Str;
use App\Models\Contest;

class Edit extends Component
{
    public function render()
    {
        return view('livewire.contests.edit')->extends('layouts.panel');
    }
}
