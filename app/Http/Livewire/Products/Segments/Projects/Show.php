<?php

namespace App\Http\Livewire\Products\Segments\Projects;

use App\Models\SegmentProject;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Show extends Component
{
    public $project;

    public function mount(SegmentProject $project)
    {
        $this->project = $project;
    }

    public function delete()
    {
        Storage::delete($this->project->image);
        Storage::delete($this->project->image_medium);
        Storage::delete($this->project->image_small);
        $this->project->delete();
        return redirect(route('products.segments.projects.index'));
    }

    public function render()
    {
        return view('livewire.products.segments.segment-projects.show')->extends('layouts.panel');
    }
}
