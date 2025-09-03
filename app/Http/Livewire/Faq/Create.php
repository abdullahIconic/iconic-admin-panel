<?php

namespace App\Http\Livewire\Faq;

use Livewire\Component;
use App\Models\Faq;

class Create extends Component
{
    public
        $faq_for,
        $question,
        $answer
    ;

    public function store()
    {
        Faq::create([
            "faq_for" => $this->faq_for,
            "question" => $this->question,
            "answer" => $this->answer,
            "created_by" => auth()->id(),
            "created_at" => now(),
        ]);

        return redirect(route('faq.index'));
    }

    public function render()
    {
        return view('livewire.faq.create')->extends('layouts.panel');
    }
}