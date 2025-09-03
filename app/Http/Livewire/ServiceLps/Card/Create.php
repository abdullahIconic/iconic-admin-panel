<?php

namespace App\Http\Livewire\ServiceLps\Card;

use Livewire\Component;

class Create extends Component
{
    public $card_type = 'image';

    public function render()
    {
        return view('livewire.serviceLps.card.create')->extends('layouts.panel');
    }
}