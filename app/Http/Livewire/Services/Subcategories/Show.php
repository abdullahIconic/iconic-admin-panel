<?php

namespace App\Http\Livewire\Services\Subcategories;

use App\Models\BestFeatureImage;
use Livewire\Component;
use App\Models\ServiceSubcategory;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
     public $serviceSubcategory ;

    public function mount(ServiceSubcategory $serviceSubcategory )
    {
        $this->serviceSubcategory = $serviceSubcategory;
    }

    public function delete()
    {
        Storage::delete($this->serviceSubcategory->image);
        Storage::delete($this->serviceSubcategory->image_medium);
        Storage::delete($this->serviceSubcategory->image_small);

        $this->serviceSubcategory->delete();

        return redirect(route('services.subcategories.index'));
    }

    public function render()
    {
        return view('livewire.services.subcategories.show')->extends('layouts.panel');
    }
}
