<?php

namespace App\Http\Livewire\Metadata;

use App\Models\Metadata;
use Livewire\Component;

class Edit extends Component
{
    public
        $data,
        $page_name,
        $title,
        $description,
        $keywords,
        $schema
    ;

    public function mount(Metadata $data)
    {
        $this->data = $data;
        $this->page_name = $data->page_name;
        $this->title = $data->title;
        $this->description = $data->description;
        $this->keywords = $data->keywords;
        $this->schema = $data->schema;
    }

    public function update()
    {
        $this->data->update([
            'page_name' => $this->page_name,
            'title' => $this->title,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'schema' => $this->schema,
            'updated_by' => auth()->id(),
            'updated_at' => now(),
        ]);
    
        return redirect(route('metadata.index'))->with('success', 'Updated!');
    }

    public function render()
    {
        return view('livewire.metadata.edit')->extends('layouts.panel');
    }
}
