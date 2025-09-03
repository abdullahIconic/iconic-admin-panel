<?php

namespace App\Http\Livewire\Activities;

use Livewire\Component;
use Str;
use App\Models\Activity;
use App\Models\ActivityCategory as Category;

class Edit extends Component
{
    public
        $visible,
        $isFeatured,
        $category,
        $title,
        $url,
        $article,
        $meta_title,
        $meta_description,
        $meta_keywords
    ;
        
    public $activity, $categories = [];

    public function mount(Activity $activity)
    {
        // Activity Data
        $this->visible = $activity->visible;
        $this->isFeatured = $activity->isFeatured;
        $this->category = $activity->category_id;
        $this->title = $activity->title;
        $this->url = $activity->url;
        $this->article = $activity->article;
        $this->meta_title = $activity->meta_title;
        $this->meta_description = $activity->meta_description;
        $this->meta_keywords = $activity->meta_keywords;

        // Other Data
        $this->activity = $activity;
        $this->categories = Category::where('visible', 1)->get();
    }

    public function updatedTitle()
    {
        $this->url = Str::slug($this->title);
    }

    public function render()
    {
        return view('livewire.activities.edit')->extends('layouts.panel');
    }
}
