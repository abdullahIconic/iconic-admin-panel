<?php

namespace App\Http\Livewire\Popup;

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.popup.create')->extends('layouts.panel');
    }
}