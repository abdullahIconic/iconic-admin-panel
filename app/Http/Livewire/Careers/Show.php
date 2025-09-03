<?php

namespace App\Http\Livewire\Careers;

use Livewire\Component;
use App\Models\Career;

class Show extends Component
{
    public $career;

    public function mount(Career $career)
    {
        $this->career = $career;
    }

    public function render()
    {
        return view('livewire.careers.show')->extends('layouts.panel');
    }
}
