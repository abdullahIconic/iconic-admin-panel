<?php

namespace App\Http\Livewire\Products\Segments;

use Livewire\Component;
use App\Models\ProductSegment as Segment;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $segment;

    public function mount(Segment $segment)
    {
        $this->segment = $segment;
    }

    public function delete()
    {
        Storage::delete($this->segment->image);
        Storage::delete($this->segment->image_medium);
        Storage::delete($this->segment->image_small);
        $this->segment->delete();
        return redirect(route('products.segments.index'));
    }

    public function render()
    {
        return view('livewire.products.segments.show')->extends('layouts.panel');
    }
}
