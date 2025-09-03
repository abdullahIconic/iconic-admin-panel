<?php

namespace App\Http\Livewire\ServiceList;

use Livewire\Component;
use App\Models\ServiceList;

class Edit extends Component
{
    public
        $service,
        $visible,
        $title,
        $identifier,
        $service_for,
        $services,
        $overview,
        $caption
    ;

    public function mount(ServiceList $service)
    {
        $this->service = $service;
        $this->visible = $service->visible;
        $this->title = $service->title;
        $this->identifier = $service->identifier;
        $this->service_for = $service->service_for;
        $this->services = $service->services;
        $this->overview = $service->overview;
        $this->caption = $service->caption;
    }

    public function render()
    {
        return view('livewire.service-list.edit')->extends('layouts.panel');
    }
}
