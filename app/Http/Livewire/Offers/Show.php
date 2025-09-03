<?php

namespace App\Http\Livewire\Offers;

use Livewire\Component;
use App\Models\Offer;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $offer;

    public function mount(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function delete()
    {
        Storage::delete($this->offer->image);
        Storage::delete($this->offer->image_medium);
        Storage::delete($this->offer->image_small);

        $this->offer->delete();

        return redirect(route('offers.index'));
    }

    public function render()
    {
        return view('livewire.offers.show')->extends('layouts.panel');
    }
}
