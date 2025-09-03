<?php

namespace App\Http\Livewire\Offers;

use Livewire\Component;
use Str;

class Create extends Component
{
    public $title, $meta_title, $url;

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }
    public function render()
    {
        return view('livewire.offers.create')->extends('layouts.panel');
    }
}