<?php

namespace App\Http\Livewire\Resource\Items;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use App\Models\ResourceItem;

class Show extends Component
{
    public $item;

    public function mount(ResourceItem $item)
    {
        $this->item = $item;
    }

    public function delete()
    {
        Storage::delete($this->item->image);
        Storage::delete($this->item->image_medium);
        Storage::delete($this->item->image_small);

        $this->item->delete();

        return redirect(route('resource.items.index'));
    }

    public function render()
    {
        return view('livewire.resource.items.show')->extends('layouts.panel');
    }
}
