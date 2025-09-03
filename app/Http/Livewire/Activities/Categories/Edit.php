<?php

namespace App\Http\Livewire\Activities\Categories;

use Livewire\Component;
use Str;
use App\Models\ActivityCategory as Category;

class Edit extends Component
{
    public
        $category,
        $visible,
        $title,
        $url,
        $description,
        $meta_title,
        $meta_description,
        $meta_keywords
    ;

    public function mount(Category $category)
    {
        // Category Data
        $this->category = $category;

        $this->visible = $category->visible;
        $this->title = $category->title;
        $this->url = $category->url;
        $this->description = $category->description;
        $this->meta_title = $category->meta_title;
        $this->meta_description = $category->meta_description;
        $this->meta_keyword = $category->meta_keywordss;
    }

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function update()
    {
        $this->category->update([
            "visible" => $this->visible,
            "title" => $this->title,
            "url" => $this->url,
            "description" => $this->description,
            "meta_title" => $this->meta_title,
            "meta_description" => $this->meta_description,
            "meta_keywords" => $this->meta_keywords,
            "updated_by" => auth()->id(),
            "updated_at" => now(),
        ]);

        return redirect(route('activities.categories.index'));
    }

    public function render()
    {
        return view('livewire.activities.categories.edit')->extends('layouts.panel');
    }
}
