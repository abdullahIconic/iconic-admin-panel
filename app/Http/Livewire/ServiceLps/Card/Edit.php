<?php

namespace App\Http\Livewire\ServiceLps\Card;

use Livewire\Component;
use Str;
use App\Models\LpsCard;

class Edit extends Component
{
    public $card;
    public $visible;
    public $page_name;
    public $card_for;
    public $card_type;
    public $title;
    public $url;
    public $overview;

    public function mount(LpsCard $card)
    {
        $this->card = $card;
        $this->visible = $card->visible;
        $this->page_name = $card->page_name;
        $this->card_for = $card->card_for;
        $this->card_type = $card->card_type;
        $this->title = $card->title;
        $this->url = $card->url;
        $this->overview = $card->overview;
    }

    public function render()
    {
        return view('livewire.serviceLps.card.edit')->extends('layouts.panel');
    }
}
