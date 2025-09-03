<?php

namespace App\Http\Livewire\Solutions\SolutionItem;

use Livewire\Component;
use App\Models\SolutionItem;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $solution;

    public function mount(SolutionItem $solution)
    {
        $this->solution = $solution;
    }

    public function delete()
    {
        Storage::delete($this->solution->image);
        Storage::delete($this->solution->image_medium);
        Storage::delete($this->solution->image_small);

        $this->solution->delete();

        return redirect(route('solutions.solution-items.index'));
    }

    public function render()
    {
        return view('livewire.solutions.solutionItem.show')->extends('layouts.panel');
    }
}
