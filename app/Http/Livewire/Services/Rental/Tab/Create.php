<?php

namespace App\Http\Livewire\Services\Rental\Tab;

use Livewire\Component;
use Str;
use App\Models\RentalTab;

class Create extends Component
{
    public
        $visible = 1,
        $title,
        $description
    ;

    public function store()
    {
        RentalTab::create([
            "visible" => $this->visible,
            "title" => $this->title,
            "description" => $this->description,
            "created_by" => auth()->id(),
            "created_at" => now(),
        ]);

        return redirect(route('services.rental.tabs.index'))->with('success', 'Success!');
    }

    public function render()
    {
        return view('livewire.services.rental.tab.create')->extends('layouts.panel');
    }
}