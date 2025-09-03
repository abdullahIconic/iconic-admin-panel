<?php

namespace App\Http\Livewire\Activities\Categories;

use Livewire\Component;
use App\Models\ActivityCategory as Category;

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
        return redirect(route('activities.categories.index'));
    }

    public function render()
    {
        return view('livewire.activities.categories.show')->extends('layouts.panel');
    }
}
