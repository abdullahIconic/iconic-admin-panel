<?php

namespace App\Http\Livewire\ServiceCarousel;

use App\Models\ServiceCarousel;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $carousel;

    public function mount(ServiceCarousel $carousel)
    {
        $this->carousel = $carousel;
    }

    public function delete()
    {
        $this->carousel->delete();
        return redirect(route('service-carousel.index'));
    }

    public function render()
    {
        return view('livewire.service-carousel.show')->extends('layouts.panel');
    }
}
