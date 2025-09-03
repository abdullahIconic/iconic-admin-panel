<?php

namespace App\Http\Livewire\Blogs;

use App\Models\Team;
use Livewire\Component;
use Str;
use App\Models\Blog;
use App\Models\BlogCategory as Category;

class Create extends Component
{
    public
        $visible = 1,
        $language,
        $isFeatured = 0,
        $category,
        $title,
        $url,
        $article,
        $meta_title,
        $meta_description,
        $meta_keywords,
        $authored_by
    ;

    public $categories = [];
    public $authors = [];

    public function mount()
    {
        $this->categories = Category::where('language', 'en')
                                    ->where('visible', 1)
                                    ->get();
        $this->authors = Team::where('visible', 1)
            ->get();
    }

    public function updatedTitle()
    {
        $this->url = Str::slug($this->title);
    }

    public function updatedLanguage()
    {
        $this->categories = Category::where('language', $this->language)
                                    ->where('visible', 1)
                                    ->get();
    }

    public function render()
    {
        return view('livewire.blogs.create')->extends('layouts.panel');
    }
}
