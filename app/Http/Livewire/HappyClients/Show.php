<?php

namespace App\Http\Livewire\HappyClients;

use Livewire\Component;
use App\Models\HappyClient;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $client;

    public function mount(HappyClient $client)
    {
        $this->client = $client;
    }

    public function delete()
    {
        Storage::delete($this->client->image);
        Storage::delete($this->client->image_medium);
        Storage::delete($this->client->image_small);

        $this->client->delete();

        return redirect(route('happy-clients.index'));
    }

    public function render()
    {
        return view('livewire.happy-clients.show')->extends('layouts.panel');
    }
}
