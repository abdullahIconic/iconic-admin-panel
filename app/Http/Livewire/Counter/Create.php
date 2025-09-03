<?php

namespace App\Http\Livewire\Counter;

use Livewire\Component;
use App\Models\Counter;

class Create extends Component
{
    public
        $label,
        $counter_for,
        $digit
    ;

    public function store()
    {
        Counter::create([
            "label" => $this->label,
            "counter_for" => $this->counter_for,
            "digit" => $this->digit,
            "created_by" => auth()->id(),
            "created_at" => now(),
        ]);

        return redirect(route('counter.index'));
    }

    public function render()
    {
        return view('livewire.counter.create')->extends('layouts.panel');
    }
}