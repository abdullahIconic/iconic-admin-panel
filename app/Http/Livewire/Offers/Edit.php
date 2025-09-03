<?php

namespace App\Http\Livewire\Offers;

use Livewire\Component;
use Str;
use App\Models\Offer;
use Carbon\Carbon;

class Edit extends Component
{
    public $offer, $visible, $title, $meta_title, $url, $starting_date, $ending_date;

    public function mount(Offer $offer)
    {
        $this->offer = $offer;
        $this->visible = $offer->visible;
        $this->title = $offer->title;
        $this->meta_title = $offer->meta_title;
        $this->url = $offer->url;
        $this->starting_date = Carbon::parse($offer->starting_date)->format('Y-m-d');
        $this->ending_date = Carbon::parse($offer->ending_date)->format('Y-m-d');
    }

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function render()
    {
        return view('livewire.offers.edit')->extends('layouts.panel');
    }
}
