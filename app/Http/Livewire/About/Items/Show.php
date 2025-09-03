<?php

namespace App\Http\Livewire\About\Items;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use App\Models\AboutItem;

class Show extends Component
{
    public $item;

    public function mount(AboutItem $item)
    {
        $this->item = $item;
    }

    public function delete()
    {
        Storage::delete($this->item->image);
        Storage::delete($this->item->image_medium);
        Storage::delete($this->item->image_small);

        $this->item->delete();

        return redirect(route('about.items.index'));
    }

    public function render()
    {
        return view('livewire.about.items.show')->extends('layouts.panel');
    }
}
