<?php

namespace App\Http\Livewire\GrowthPaths;

use Livewire\Component;

use App\Models\GrowthPath;

class Edit extends Component
{
    public $growthpath;

    public function mount(GrowthPath $growthpath)
    {
        $this->growthpath = $growthpath;
    }

    public function render()
    {
        return view('livewire.growthpath.edit')->extends('layouts.panel');
    }
}
