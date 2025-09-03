<?php

namespace App\Http\Livewire\ServiceCarousel;

use Livewire\Component;
use App\Models\ServiceCarousel;

class Edit extends Component
{
    public
        $carousel,
        $visible,
        $carousel_for,
        $title,
        $url,
        $overview
    ;

    public function mount(ServiceCarousel $carousel)
    {
        $this->carousel = $carousel;
        $this->visible = $carousel->visible;
        $this->carousel_for = $carousel->carousel_for;
        $this->title = $carousel->title;
        $this->url = $carousel->url;
        $this->overview = $carousel->overview;
    }

    public function update()
    {
        $this->carousel->update([
            "visible" => $this->visible,
            "carousel_for" => $this->carousel_for,
            "title" => $this->title,
            "url" => $this->url,
            "overview" => $this->overview,
            "updated_by" => auth()->id(),
            "updated_at" => now(),
        ]);

        return redirect(route('service-carousel.index'));
    }

    public function render()
    {
        return view('livewire.service-carousel.edit')->extends('layouts.panel');
    }
}
