<?php

namespace App\Http\Livewire\SectionData;

use App\Models\SectionData;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $section;

    public function mount(SectionData $section)
    {
        $this->section = $section;
    }

    public function delete()
    {
        Storage::delete($this->section->image);
        $this->section->delete();
        return redirect(route('section-data.index'));
    }

    public function render()
    {
        return view('livewire.section-data.show')->extends('layouts.panel');
    }
}
