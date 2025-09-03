<?php

namespace App\Http\Livewire\Offers\Banners;

use Livewire\Component;
use App\Models\OfferBanner;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $banner;

    public function mount(OfferBanner $banner)
    {
        $this->banner = $banner;
    }

    public function delete()
    {
        Storage::delete($this->banner->image);
        Storage::delete($this->banner->image_medium);
        Storage::delete($this->banner->image_small);

        $this->banner->delete();

        return redirect(route('offers.banners.index'));
    }

    public function render()
    {
        return view('livewire.offers.banners.show')->extends('layouts.panel');
    }
}
