<?php

namespace App\Http\Livewire\Services\Safety;

use Livewire\Component;
use Str;
use App\Models\ServiceSafety;

class Edit extends Component
{
    public $safety;
    public
        $visible,
        $slogan,
        $title,
        $url,
        $label,
        $overview
    ;

    public function mount(ServiceSafety $safety)
    {
        $this->safety = $safety;
        $this->visible = $safety->visible;
        $this->slogan = $safety->slogan;
        $this->title = $safety->title;
        $this->url = $safety->url;
        $this->label = $safety->label;
        $this->overview = $safety->overview;
    }

    public function update()
    {
        $this->safety->update([
            "visible" => $this->visible,
            "slogan" => $this->slogan,
            "title" => $this->title,
            "url" => $this->url,
            "label" => $this->label,
            "overview" => $this->overview,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        return redirect(route('services.safety.index'))->with('success', 'Success!');
    }

    public function render()
    {
        return view('livewire.services.safety.edit')->extends('layouts.panel');
    }
}
