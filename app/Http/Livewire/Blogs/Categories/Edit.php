<?php

namespace App\Http\Livewire\Blogs\Categories;

use Livewire\Component;
use Str;
use App\Models\BlogCategory as Category;

class Edit extends Component
{
    public
        $category,
        $visible,
        $language,
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
        $this->language = $category->language;
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
            "language" => $this->language,
            "title" => $this->title,
            "url" => $this->url,
            "description" => $this->description,
            "meta_title" => $this->meta_title,
            "meta_description" => $this->meta_description,
            "meta_keywords" => $this->meta_keywords,
            "updated_by" => auth()->id(),
            "updated_at" => now(),
        ]);

        return redirect(route('blogs.categories.index'));
    }

    public function render()
    {
        return view('livewire.blogs.categories.edit')->extends('layouts.panel');
    }
}
