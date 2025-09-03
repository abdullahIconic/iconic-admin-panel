<?php

namespace App\Http\Livewire\Blogs;

use App\Models\Team;
use Livewire\Component;
use Str;
use App\Models\Blog;
use App\Models\BlogCategory as Category;

class Edit extends Component
{
    public
        $visible,
        $language,
        $isFeatured,
        $category,
        $title,
        $url,
        $article,
        $meta_title,
        $meta_description,
        $meta_keywords,
        $authored_by
    ;

    public $blog, $categories = [], $authors = [];

    public function mount(Blog $blog)
    {
        // Blog Data
        $this->visible = $blog->visible;
        $this->language = $blog->language;
        $this->isFeatured = $blog->isFeatured;
        $this->category = $blog->category_id;
        $this->title = $blog->title;
        $this->url = $blog->url;
        $this->article = $blog->article;
        $this->meta_title = $blog->meta_title;
        $this->meta_description = $blog->meta_description;
        $this->meta_keywords = $blog->meta_keywords;
        $this->authored_by = $blog->authored_by;

        // Other Data
        $this->blog = $blog;
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
        return view('livewire.blogs.edit')->extends('layouts.panel');
    }
}
