<?php

namespace App\Http\Livewire\Sliders;

use Livewire\Component;
use Str;
use App\Models\Slider;

class Create extends Component
{
    public
        $visible = 1,
        $page_name = 'home',
        $segment_slug = '',
        $slogan,
        $position,
        $slogan_color,
        $title,
        $title_color,
        $overview,
        $overview_color,
        $link,
        $link_text,
        $button_color,
        $label_color
    ;

    public function render()
    {
        return view('livewire.sliders.create')->extends('layouts.panel');
    }
}
