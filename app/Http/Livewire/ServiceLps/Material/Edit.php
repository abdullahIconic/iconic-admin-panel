<?php

namespace App\Http\Livewire\ServiceLps\Material;

use Livewire\Component;
use Str;
use App\Models\LpsMaterial;

class Edit extends Component
{
    public $material;
    public $visible;
    public $material_for;
    public $title;

    public function mount(LpsMaterial $material)
    {
        $this->material = $material;
        $this->visible = $material->visible;
        $this->material_for = $material->material_for;
        $this->title = $material->title;
    }

    public function render()
    {
        return view('livewire.serviceLps.material.edit')->extends('layouts.panel');
    }
}
