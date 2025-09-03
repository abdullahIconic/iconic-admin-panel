<?php

namespace App\Http\Livewire\ServiceList;

use App\Models\ServiceList;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $service;

    public function mount(ServiceList $service)
    {
        $this->service = $service;
    }

    public function delete()
    {
        Storage::delete($this->service->image);
        Storage::delete($this->service->image_medium);
        Storage::delete($this->service->image_small);
        $this->service->delete();
        return redirect(route('service-list.index'));
    }

    public function render()
    {
        return view('livewire.service-list.show')->extends('layouts.panel');
    }
}
