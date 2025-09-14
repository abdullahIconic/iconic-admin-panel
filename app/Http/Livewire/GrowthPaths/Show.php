<?php

namespace App\Http\Livewire\GrowthPaths;

use Livewire\Component;
use App\Models\GrowthPath;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $client;

    public function mount(GrowthPath $client)
    {
        $this->client = $client;
    }

    public function delete()
    {
        Storage::delete($this->client->image);
        Storage::delete($this->client->image_medium);
        Storage::delete($this->client->image_small);

        $this->client->delete();

        return redirect(route('growthpaths.index'));
    }

    public function render()
    {
        return view('livewire.growthpath.show')->extends('layouts.panel');
    }
}
