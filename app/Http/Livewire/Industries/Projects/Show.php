<?php

namespace App\Http\Livewire\Industries\Projects;

use App\Models\IndustryProject;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Show extends Component
{
    public $project;

    public function mount(IndustryProject $project)
    {
        $this->project = $project;
    }

    public function delete()
    {
        Storage::delete($this->project->image);
        Storage::delete($this->project->image_medium);
        Storage::delete($this->project->image_small);
        $this->project->delete();
        return redirect(route('industries.projects.index'));
    }

    public function render()
    {
        return view('livewire.industries.industry-projects.show')->extends('layouts.panel');
    }
}
