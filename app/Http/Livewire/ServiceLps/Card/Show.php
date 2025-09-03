<?php

namespace App\Http\Livewire\ServiceLps\Card;

use Livewire\Component;
use App\Models\LpsCard;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $card;

    public function mount(LpsCard $card)
    {
        $this->card = $card;
    }

    public function delete()
    {
        Storage::delete($this->card->image);
        Storage::delete($this->card->image_medium);
        Storage::delete($this->card->image_small);

        $this->card->delete();

        return redirect(route('serviceLps.card.index'));
    }

    public function render()
    {
        return view('livewire.serviceLps.card.show')->extends('layouts.panel');
    }
}
