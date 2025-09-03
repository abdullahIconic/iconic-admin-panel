<?php

namespace App\Http\Livewire\HappyClients;

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.happy-clients.create')->extends('layouts.panel');
    }
}