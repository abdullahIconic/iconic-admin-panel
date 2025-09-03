<?php

namespace App\Http\Livewire\Popup;

use Livewire\Component;

use App\Models\Popup;

class Edit extends Component
{
    public $popup;

    public function mount(Popup $popup)
    {
        $this->popup = $popup;
    }

    public function render()
    {
        return view('livewire.popup.edit')->extends('layouts.panel');
    }
}
