<?php

namespace App\Http\Livewire\Solutions\SolutionItem;

use Livewire\Component;
use Str;
use App\Models\SolutionItem;

class Edit extends Component
{
    public
        $solution,
        $visible,
        $slogan,
        $title,
        $overview
    ;

    public function mount(SolutionItem $solution)
    {
        $this->solution = $solution;
        $this->visible = $solution->visible;
        $this->slogan = $solution->slogan;
        $this->title = $solution->title;
        $this->overview = $solution->overview;
    }

    public function update()
    {
        $this->solution->update([
            "visible" => $this->visible,
            "slogan" => $this->slogan,
            "title" => $this->title,
            "overview" => $this->overview,
            "updated_by" => auth()->id(),
            "updated_at" => now(),
        ]);

        return redirect(route('solutions.solution-items.index'));
    }

    public function render()
    {
        return view('livewire.solutions.solutionItem.edit')->extends('layouts.panel');
    }
}
