<?php

namespace App\Http\Livewire\Team;

use Livewire\Component;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $member;

    public function mount(Team $team)
    {
        $this->member = $team;
    }

    public function delete()
    {
        Storage::delete($this->member->image);
        Storage::delete($this->member->image_medium);
        Storage::delete($this->member->image_small);

        $this->member->delete();
        return redirect(route('team.index'));
    }

    public function render()
    {
        return view('livewire.team.show')->extends('layouts.panel');
    }
}
