<?php

namespace App\Http\Livewire\Gallery;

use Livewire\Component;

use App\Models\Gallery;

class Edit extends Component
{
    public $gallery;
    public function mount(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    public function render()
    {
        return view('livewire.gallery.edit')->extends('layouts.panel');
    }
}
