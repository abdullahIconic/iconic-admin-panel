<?php

namespace App\Http\Livewire\ServiceLps\Material;

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.serviceLps.material.create')->extends('layouts.panel');
    }
}