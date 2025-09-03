<?php

namespace App\Http\Livewire\Services\Safety;

use App\Models\ServiceSafety;
use Livewire\Component;

class Create extends Component
{
    public
        $visible = 1,
        $slogan,
        $title,
        $url,
        $label,
        $overview
    ;

    public function store()
    {
        ServiceSafety::create([
            "visible" => $this->visible,
            "slogan" => $this->slogan,
            "title" => $this->title,
            "url" => $this->url,
            "label" => $this->label,
            "overview" => $this->overview,
            "created_by" => auth()->id(),
            "created_at" => now(),
        ]);

        return redirect(route('services.safety.index'))->with('success', 'Success!');
    }

    public function render()
    {
        return view('livewire.services.safety.create')->extends('layouts.panel');
    }
}