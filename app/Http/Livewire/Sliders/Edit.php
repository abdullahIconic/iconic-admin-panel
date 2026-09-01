<?php

namespace App\Http\Livewire\Sliders;

use Livewire\Component;
use Str;
use App\Models\Slider;

class Edit extends Component
{
    public
        $slider,
        $visible,
        $page_name,
        $segment_slug,
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

    public function mount(Slider $slider)
    {
        $this->slider = $slider;

        $this->visible = $slider->visible;
        $this->page_name = $slider->page_name;
        $this->segment_slug = $slider->segment_slug;
        $this->slogan = $slider->slogan;
        $this->position = $slider->position;
        $this->slogan_color = $slider->slogan_color;
        $this->title = $slider->title;
        $this->title_color = $slider->title_color;
        $this->overview = $slider->overview;
        $this->overview_color = $slider->overview_color;
        $this->link = $slider->link;
        $this->link_text = $slider->link_text;
        $this->button_color = $slider->button_color;
        $this->label_color = $slider->label_color;
    }

    public function render()
    {
        return view('livewire.sliders.edit')->extends('layouts.panel');
    }
}
