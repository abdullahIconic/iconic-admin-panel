<?php

namespace App\Http\Livewire\Services\ServiceWwd;

use Livewire\Component;
use App\Models\ServiceWwd;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $work;

    public function mount(ServiceWwd $work)
    {
        $this->work = $work;
    }

    public function delete()
    {
        Storage::delete($this->work->image);
        Storage::delete($this->work->image_medium);
        Storage::delete($this->work->image_small);

        $this->work->delete();

        return redirect(route('services.what-we-delivered.index'));
    }

    public function render()
    {
        return view('livewire.services.serviceWwd.show')->extends('layouts.panel');
    }
}
