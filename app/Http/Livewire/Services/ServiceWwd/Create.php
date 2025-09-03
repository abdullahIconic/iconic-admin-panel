<?php

namespace App\Http\Livewire\Services\ServiceWwd;

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.services.serviceWwd.create')->extends('layouts.panel');
    }
}