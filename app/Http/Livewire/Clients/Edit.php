<?php

namespace App\Http\Livewire\Clients;

use Livewire\Component;

use App\Models\Client;

class Edit extends Component
{
    public $client;

    public function mount(Client $client)
    {
        $this->client = $client;
    }

    public function render()
    {
        return view('livewire.clients.edit')->extends('layouts.panel');
    }
}
