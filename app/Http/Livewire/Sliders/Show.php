<?php

namespace App\Http\Livewire\Sliders;

use Livewire\Component;
use App\Models\Slider;

class Show extends Component
{
    public $slider;

    public function mount(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function render()
    {
        return view('livewire.sliders.show')->extends('layouts.panel');
    }
}
