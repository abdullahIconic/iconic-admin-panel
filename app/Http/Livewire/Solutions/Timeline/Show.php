<?php

namespace App\Http\Livewire\Solutions\Timeline;

use Livewire\Component;
use App\Models\SolutionTimeline;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $timeline;

    public function mount(SolutionTimeline $timeline)
    {
        $this->timeline = $timeline;
    }

    public function delete()
    {
        Storage::delete($this->timeline->image);
        Storage::delete($this->timeline->image_medium);
        Storage::delete($this->timeline->image_small);

        $this->timeline->delete();

        return redirect(route('solutions.timeline.index'));
    }

    public function render()
    {
        return view('livewire.solutions.timeline.show')->extends('layouts.panel');
    }
}
