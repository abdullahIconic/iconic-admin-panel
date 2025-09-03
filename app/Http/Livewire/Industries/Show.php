<?php

namespace App\Http\Livewire\Industries;

use App\Models\Industry;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Show extends Component
{
    public $industry;

    public function mount(Industry $industry)
    {
        $this->industry = $industry;
    }

    public function delete()
    {
        Storage::delete($this->industry->image);
        Storage::delete($this->industry->image_medium);
        Storage::delete($this->industry->image_small);
        $this->industry->delete();
        return redirect(route('industries.index'));
    }

    public function render()
    {
        return view('livewire.industries.show')->extends('layouts.panel');
    }
}
