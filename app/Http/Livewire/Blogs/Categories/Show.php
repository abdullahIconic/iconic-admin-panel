<?php

namespace App\Http\Livewire\Blogs\Categories;

use Livewire\Component;
use App\Models\BlogCategory as Category;

class Show extends Component
{
    public $category;

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function delete()
    {
        $this->category->delete();
        return redirect(route('blogs.categories.index'));
    }

    public function render()
    {
        return view('livewire.blogs.categories.show')->extends('layouts.panel');
    }
}
