<?php

namespace App\Http\Livewire\About\Items;

use Livewire\Component;
use Str;
use App\Models\AboutItem;

class Create extends Component
{
    public
        $visible = 1,
        $language,
        $slogan,
        $title,
        $url,
        $description,
        $meta_title,
        $meta_description,
        $meta_keywords
    ;

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function store()
    {
        AboutItem::create([
            "visible" => $this->visible,
            "slogan" => $this->slogan,
            "title" => $this->title,
            "url" => $this->url,
            "description" => $this->description,
            "meta_title" => $this->meta_title,
            "meta_description" => $this->meta_description,
            "meta_keywords" => $this->meta_keywords
        ]);
    }

    public function render()
    {
        return view('livewire.about.items.create')->extends('layouts.panel');
    }
}