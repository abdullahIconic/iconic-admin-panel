<?php

namespace App\Http\Livewire\Gallery;

use Livewire\Component;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $gallery;

    public function mount(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    public function delete()
    {
        Storage::delete($this->gallery->image);
        Storage::delete($this->gallery->image_medium);
        Storage::delete($this->gallery->image_small);

        $this->gallery->delete();
        return redirect(route('gallery.index'));
    }

    public function render()
    {
        return view('livewire.gallery.show')->extends('layouts.panel');
    }
}
