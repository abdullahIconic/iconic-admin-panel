<?php

namespace App\Http\Livewire\Offers\Banners;

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.offers.banners.create')->extends('layouts.panel');
    }
}