<?php

namespace App\Http\Livewire\Blogs;

use Livewire\Component;
use App\Models\Blog;

class Show extends Component
{
    public $blog;

    public function mount(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function render()
    {
        return view('livewire.blogs.show')->extends('layouts.panel');
    }
}
