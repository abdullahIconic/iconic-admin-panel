<?php

namespace App\Http\Livewire\Activities;

use Livewire\Component;
use App\Models\Activity;

class Show extends Component
{
    public $activity;

    public function mount(Activity $activity)
    {
        $this->activity = $activity;
    }

    public function render()
    {
        return view('livewire.activities.show')->extends('layouts.panel');
    }
}
