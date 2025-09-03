<?php

namespace App\Http\Livewire\Clients;

use Livewire\Component;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $client;

    public function mount(Client $client)
    {
        $this->client = $client;
    }

    public function delete()
    {
        Storage::delete($this->client->image);
        Storage::delete($this->client->image_medium);
        Storage::delete($this->client->image_small);

        $this->client->delete();

        return redirect(route('clients.index'));
    }

    public function render()
    {
        return view('livewire.clients.show')->extends('layouts.panel');
    }
}
