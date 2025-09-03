<?php

namespace App\Http\Livewire\Offers\Banners;

use Livewire\Component;
use Str;
use App\Models\OfferBanner;

class Edit extends Component
{
    public $visible, $banner;

    public function mount(OfferBanner $banner)
    {
        // Category Data
        $this->banner = $banner;
        $this->visible = $banner->visible;
    }

    public function render()
    {
        return view('livewire.offers.banners.edit')->extends('layouts.panel');
    }
}
