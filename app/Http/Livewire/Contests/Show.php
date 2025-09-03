<?php

namespace App\Http\Livewire\Contests;

use Livewire\Component;
use App\Models\Contest;

class Show extends Component
{
    public $contest;

    public function mount(Contest $contest)
    {
        $this->Contest = $contest;
    }

    public function render()
    {
        return view('livewire.contests.show')->extends('layouts.panel');
    }
}
