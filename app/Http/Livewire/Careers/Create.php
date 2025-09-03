<?php

namespace App\Http\Livewire\Careers;

use Livewire\Component;
use Str;
use App\Models\CareerCategory as Category;

class Create extends Component
{
    public
        $visible = 1,
        $title,
        $url,
        $description,
        $meta_title,
        $meta_description,
        $meta_keywords,
        $button_text,
        $button_url
    ;

    public function updatedTitle()
    {
        $this->url = Str::slug($this->title);
    }

    public function render()
    {
        return view('livewire.careers.create')->extends('layouts.panel');
    }
}
