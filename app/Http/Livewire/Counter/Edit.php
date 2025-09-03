<?php

namespace App\Http\Livewire\Counter;

use Livewire\Component;
use App\Models\Counter;

class Edit extends Component
{
    public
        $counter,
        $label,
        $counter_for,
        $digit
    ;

    public function mount(Counter $counter)
    {
        $this->counter = $counter;
        $this->label = $counter->label;
        $this->counter_for = $counter->counter_for;
        $this->digit = $counter->digit;
    }

    public function update()
    {
        $this->counter->update([
            "label" => $this->label,
            "counter_for" => $this->counter_for,
            "digit" => $this->digit,
            "updated_by" => auth()->id(),
            "updated_at" => now(),
        ]);

        return redirect(route('counter.index'));
    }

    public function render()
    {
        return view('livewire.counter.edit')->extends('layouts.panel');
    }
}
