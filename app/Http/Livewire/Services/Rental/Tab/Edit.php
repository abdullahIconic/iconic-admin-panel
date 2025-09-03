<?php

namespace App\Http\Livewire\Services\Rental\Tab;

use App\Models\RentalTab;
use Livewire\Component;

class Edit extends Component
{
    public
        $visible,
        $title,
        $description
    ;

    public function mount(RentalTab $tab)
    {
        $this->tab = $tab;

        $this->visible = $tab->visible;
        $this->title = $tab->title;
        $this->description = $tab->description;
    }

    public function update()
    {
        $tab = $this->tab;

        $tab->visible = $this->visible;
        $tab->title = $this->title;
        $tab->description = $this->description;
        $tab->updated_by = auth()->id();
        $tab->updated_at = now();
        $tab->save();

        return redirect(route('services.rental.tabs.index'))->with('success', 'Success!');
    }

    public function render()
    {
        return view('livewire.services.rental.tab.edit')->extends('layouts.panel');
    }
}
