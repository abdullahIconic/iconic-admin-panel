<?php

namespace App\Http\Livewire\Services;

use Livewire\Component;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $service;

    public function mount(Service $service)
    {
        $this->service = $service;
    }

    public function delete()
    {
        Storage::delete($this->service->image);
        Storage::delete($this->service->image_medium);
        Storage::delete($this->service->image_small);

        $this->service->delete();

        return redirect(route('services.index'));
    }

    public function render()
    {
        return view('livewire.services.show')->extends('layouts.panel');
    }
}
