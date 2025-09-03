<?php

namespace App\Http\Livewire\Industries\Solutions;

use App\Models\IndustrySolution;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Show extends Component
{
    public $solution;

    public function mount(IndustrySolution $solution)
    {
        $this->solution = $solution;
    }

    public function delete()
    {
        Storage::delete($this->solution->image);
        Storage::delete($this->solution->image_medium);
        Storage::delete($this->solution->image_small);
        $this->solution->delete();
        return redirect(route('industries.solutions.index'));
    }

    public function render()
    {
        return view('livewire.industries.industry-solutions.show')->extends('layouts.panel');
    }
}
