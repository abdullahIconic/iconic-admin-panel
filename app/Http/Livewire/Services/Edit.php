<?php

namespace App\Http\Livewire\Services;

use Livewire\Component;
use Str;
use App\Models\Service;
use App\Models\ServiceCategory as Category;

class Edit extends Component
{
    public
        $visible,
        $highlighted,
        $category,
        $slogan,
        $title,
        $url,
        $article,
        $meta_title,
        $meta_description,
        $meta_keywords
    ;
        
    public $service, $categories = [];

    public function mount(Service $service)
    {
        // Service Data
        $this->visible = $service->visible;
        $this->highlighted = $service->highlighted;
        $this->category = $service->category_id;
        $this->slogan = $service->slogan;
        $this->title = $service->title;
        $this->url = $service->url;
        $this->article = $service->article;
        $this->meta_title = $service->meta_title;
        $this->meta_description = $service->meta_description;
        $this->meta_keywords = $service->meta_keywords;

        // Other Data
        $this->service = $service;
        $this->categories = Category::where('visible', 1)->get();
    }

    public function updatedTitle()
    {
        $this->url = Str::slug($this->title);
    }

    public function render()
    {
        return view('livewire.services.edit')->extends('layouts.panel');
    }
}