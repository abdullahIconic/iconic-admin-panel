<?php

namespace App\Http\Livewire\Faq;

use Livewire\Component;
use App\Models\Faq;

class Edit extends Component
{
    public
        $faq,
        $question,
        $carousel_for,
        $answer
    ;

    public function mount(Faq $faq)
    {
        $this->faq = $faq;
        $this->faq_for = $faq->faq_for;
        $this->question = $faq->question;
        $this->answer = $faq->answer;
    }

    public function update()
    {
        $this->faq->update([
            "faq_for" => $this->faq_for,
            "question" => $this->question,
            "answer" => $this->answer,
            "updated_by" => auth()->id(),
            "updated_at" => now(),
        ]);

        return redirect(route('faq.index'));
    }

    public function render()
    {
        return view('livewire.faq.edit')->extends('layouts.panel');
    }
}
