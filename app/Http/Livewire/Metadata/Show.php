<?php

namespace App\Http\Livewire\Metadata;

use App\Models\Metadata;
use Livewire\Component;

class Show extends Component
{
    public $data;

    public function mount(Metadata $data)
    {
        $this->data = $data;
    }

    public function delete()
    {
        $this->data->delete();
        return redirect(route('metadata.index'));
    }

    public function render()
    {
        return view('livewire.metadata.show')->extends('layouts.panel');
    }
}
