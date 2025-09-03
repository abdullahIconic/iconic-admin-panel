<?php

namespace App\Http\Livewire\ServiceLps\Material;

use Livewire\Component;
use App\Models\LpsMaterial;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $material;

    public function mount(LpsMaterial $material)
    {
        $this->material = $material;
    }

    public function delete()
    {
        Storage::delete($this->material->image);
        Storage::delete($this->material->image_medium);
        Storage::delete($this->material->image_small);

        $this->material->delete();

        return redirect(route('what-we-delivered.index'));
    }

    public function render()
    {
        return view('livewire.serviceLps.material.show')->extends('layouts.panel');
    }
}
