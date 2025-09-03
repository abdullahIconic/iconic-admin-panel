<?php

namespace App\Http\Livewire\Metadata;

use App\Models\Metadata;
use Livewire\Component;

class Create extends Component
{
    public
        $page_name,
        $title,
        $description,
        $keywords,
        $schema
    ;

    public function store()
    {
        Metadata::create([
            'page_name' => $this->page_name,
            'title' => $this->title,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'schema' => $this->schema,
            'created_by' => auth()->id(),
            'created_at' => now(),
        ]);
    
        return redirect(route('metadata.index'))->with('success', 'Stored!');
    }

    public function render()
    {
        return view('livewire.metadata.create')->extends('layouts.panel');
    }
}
