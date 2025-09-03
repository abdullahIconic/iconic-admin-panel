<?php

namespace App\Http\Livewire\Services\Safety;

use Livewire\Component;
use App\Models\ServiceSafety;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $safety;

    public function mount(ServiceSafety $safety)
    {
        $this->safety = $safety;
    }

    public function delete()
    {
        Storage::delete($this->safety->image);
        Storage::delete($this->safety->image_medium);
        Storage::delete($this->safety->image_small);

        $this->safety->delete();

        return redirect(route('services.safety.index'));
    }

    public function render()
    {
        return view('livewire.services.safety.show')->extends('layouts.panel');
    }
}
