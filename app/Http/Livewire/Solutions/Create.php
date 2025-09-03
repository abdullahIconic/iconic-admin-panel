<?php

namespace App\Http\Livewire\Solutions;

use Livewire\Component;
use Str;
use App\Models\SolutionCategory as Category;

class Create extends Component
{
    public
        $visible = 1,
        $category,
        $title,
        $url,
        $article,
        $meta_title,
        $description,
        $meta_description,
        $meta_keywords
    ;
        
    public $categories = [];

    public function mount()
    {
        $this->categories = Category::where('visible', 1)->get();
    }

    public function updatedTitle()
    {
        $this->url = Str::slug($this->title);
    }

    public function render()
    {
        return view('livewire.solutions.create')->extends('layouts.panel');
    }
}