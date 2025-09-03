<?php

namespace App\Http\Livewire\Solutions\SolutionItem;

use App\Models\SolutionItem;
use Livewire\Component;

class Create extends Component
{
    public
        $visible = 1,
        $slogan,
        $title,
        $overview
    ;

    public function store()
    {
        SolutionItem::create([
            "visible" => $this->visible,
            "slogan" => $this->slogan,
            "title" => $this->title,
            "overview" => $this->overview,
            "created_by" => auth()->id(),
            "created_at" => now(),
        ]);

        return redirect(route('solutions.solution-items.index'));
    }

    public function render()
    {
        return view('livewire.solutions.solutionItem.create')->extends('layouts.panel');
    }
}