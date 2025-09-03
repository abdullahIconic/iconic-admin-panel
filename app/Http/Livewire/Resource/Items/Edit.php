<?php

namespace App\Http\Livewire\Resource\Items;

use Livewire\Component;
use Str;
use App\Models\ResourceItem;

class Edit extends Component
{
    public
        $item,
        $slogan,
        $title,
        $url,
        $description,
        $meta_title,
        $meta_description,
        $meta_keywords
    ;

    public function mount(ResourceItem $item)
    {
        $this->item = $item;
        $this->visible = $item->visible;
        $this->slogan = $item->slogan;
        $this->title = $item->title;
        $this->url = $item->url;
        $this->description = $item->description;
        $this->meta_title = $item->meta_title;
        $this->meta_description = $item->meta_description;
        $this->meta_keywords = $item->meta_keywords;
    }

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function render()
    {
        return view('livewire.resource.items.edit')->extends('layouts.panel');
    }
}
