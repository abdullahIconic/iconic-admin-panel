<?php

namespace App\Http\Livewire\Popup;

use Livewire\Component;
use App\Models\Popup;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $popup;

    public function mount(Popup $popup)
    {
        $this->popup = $popup;
    }

    public function delete()
    {
        Storage::delete($this->popup->image);
        Storage::delete($this->popup->image_medium);
        Storage::delete($this->popup->image_small);

        $this->popup->delete();

        return redirect(route('offers.index'));
    }

    public function render()
    {
        return view('livewire.popup.show')->extends('layouts.panel');
    }
}
