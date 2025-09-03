<?php

namespace App\Http\Livewire\Services\Rental\Tab;

use Livewire\Component;
use App\Models\RentalTab;

class Show extends Component
{
    public $tab;

    public function mount(RentalTab $tab)
    {
        $this->tab = $tab;
    }

    public function delete()
    {
        $this->tab->delete();

        return redirect(route('services.rental.tabs.index'));
    }

    public function render()
    {
        return view('livewire.services.rental.tab.show')->extends('layouts.panel');
    }
}
