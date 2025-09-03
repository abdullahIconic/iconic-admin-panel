<?php

namespace App\Http\Livewire\Solutions;

use Livewire\Component;
use Str;
use App\Models\Solution;
use App\Models\SolutionCategory as Category;

class Edit extends Component
{
    public
        $visible,
        $category,
        $title,
        $url,
        $article,
        $meta_title,
        $description,
        $meta_description,
        $meta_keywords
    ;
        
    public $solution, $categories = [];

    public function mount(Solution $solution)
    {
        // Solution Data
        $this->visible = $solution->visible;
        $this->category = $solution->category_id;
        $this->title = $solution->title;
        $this->url = $solution->url;
        $this->article = $solution->article;
        $this->meta_title = $solution->meta_title;
        $this->description = $solution->description;
        $this->meta_description = $solution->meta_description;
        $this->meta_keywords = $solution->meta_keywords;

        // Other Data
        $this->solution = $solution;
        $this->categories = Category::where('visible', 1)->get();
    }

    public function updatedTitle()
    {
        $this->url = Str::slug($this->title);
    }

    public function render()
    {
        return view('livewire.solutions.edit')->extends('layouts.panel');
    }
}
