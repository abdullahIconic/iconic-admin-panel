<?php

namespace App\Http\Livewire\Products\Branches;

use Livewire\Component;
use Storage;
use App\Models\BrandBranch as Branch;

class Show extends Component
{
    public $branch;

    public function mount(Branch $branch)
    {
        $this->branch = $branch;
    }

    public function delete()
    {
        $this->branch->delete();
        return redirect(route('products.branches.index'));
    }

    public function render()
    {
        return view('livewire.products.branches.show')->extends('layouts.panel');
    }
}
