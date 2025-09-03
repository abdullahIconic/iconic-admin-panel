<?php

namespace App\Http\Livewire\Services\ServiceWwd;

use Livewire\Component;
use Str;
use App\Models\ServiceWwd;

class Edit extends Component
{
    public $work;
    public $visible;
    public $title;

    public function mount(ServiceWwd $work)
    {
        $this->work = $work;
        $this->visible = $work->visible;
        $this->title = $work->title;
    }

    public function render()
    {
        return view('livewire.services.serviceWwd.edit')->extends('layouts.panel');
    }
}
