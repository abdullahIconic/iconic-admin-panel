<?php

namespace App\Http\Livewire\Products\Segments\Solutions;

use App\Models\SegmentSolution;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Show extends Component
{
    public $solution;

    public function mount(SegmentSolution $solution)
    {
        $this->solution = $solution;
    }

    public function delete()
    {
        Storage::delete($this->solution->image);
        Storage::delete($this->solution->image_medium);
        Storage::delete($this->solution->image_small);
        $this->solution->delete();
        return redirect(route('products.segments.solutions.index'));
    }

    public function render()
    {
        return view('livewire.products.segments.segment-solutions.show')->extends('layouts.panel');
    }
}
