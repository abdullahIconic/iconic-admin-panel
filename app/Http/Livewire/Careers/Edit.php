<?php

namespace App\Http\Livewire\Careers;

use Livewire\Component;
use Str;
use App\Models\Career;
use App\Models\CareerCategory as Category;

class Edit extends Component
{
    public
        $visible,
        $title,
        $url,
        $description,
        $meta_title,
        $meta_description,
        $meta_keywords,
        $button_text,
        $button_url
    ;

    public $career;

    public function mount(Career $career)
    {
        // Career Data
        $this->visible = $career->visible;
        $this->title = $career->title;
        $this->url = $career->url;
        $this->description = $career->description;
        $this->meta_title = $career->meta_title;
        $this->meta_description = $career->meta_description;
        $this->meta_keywords = $career->meta_keywords;
        $this->button_text = $career->button_text;
        $this->button_url = $career->button_url;

        // Other Data
        $this->career = $career;
    }

    public function updatedTitle()
    {
        $this->url = Str::slug($this->title);
    }

    public function render()
    {
        return view('livewire.careers.edit')->extends('layouts.panel');
    }
}
