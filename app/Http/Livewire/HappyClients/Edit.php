<?php

namespace App\Http\Livewire\HappyClients;

use Livewire\Component;

use App\Models\HappyClient;

class Edit extends Component
{
    public $client;

    public function mount(HappyClient $client)
    {
        $this->client = $client;
    }

    public function render()
    {
        return view('livewire.happy-clients.edit')->extends('layouts.panel');
    }
}
