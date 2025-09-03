<?php

namespace App\Http\Livewire\ServiceCarousel;

use Livewire\Component;
use App\Models\ServiceCarousel;

class Create extends Component
{
    public
        $visible = 1,
        $carousel_for = 'home',
        $title,
        $url,
        $overview
    ;

    public function store()
    {
        ServiceCarousel::create([
            "visible" => $this->visible,
            "carousel_for" => $this->carousel_for,
            "title" => $this->title,
            "url" => $this->url,
            "overview" => $this->overview,
            "created_by" => auth()->id(),
            "created_at" => now(),
        ]);

        return redirect(route('service-carousel.index'));
    }

    public function render()
    {
        return view('livewire.service-carousel.create')->extends('layouts.panel');
    }
}