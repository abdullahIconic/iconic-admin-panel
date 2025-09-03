<?php

namespace App\Http\Livewire\ServiceList;

use Livewire\Component;
use App\Models\ServiceList;

class Create extends Component
{
    public function render()
    {
        return view('livewire.service-list.create')->extends('layouts.panel');
    }
}