<?php

namespace App\Http\Livewire\Solutions\Categories;

use Livewire\Component;
use App\Models\SolutionCategory as Category;

class Show extends Component
{
    public $category;

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.solutions.categories.show')->extends('layouts.panel');
    }
}
