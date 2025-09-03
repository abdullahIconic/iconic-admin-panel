<?php

namespace App\Http\Livewire\Solutions\Timeline;

use Livewire\Component;
use Str;
use App\Models\SolutionTimeline;

class Edit extends Component
{
    public
        $timeline,
        $visible,
        $title_1,
        $overview_1,
        $title_2,
        $overview_2,
        $title_3,
        $overview_3
    ;

    public function mount(SolutionTimeline $timeline)
    {
        $this->timeline = $timeline;
        $this->visible = $timeline->visible;
        $this->title_1 = $timeline->title_1;
        $this->overview_1 = $timeline->overview_1;
        $this->title_2 = $timeline->title_2;
        $this->overview_2 = $timeline->overview_2;
        $this->title_3 = $timeline->title_3;
        $this->overview_3 = $timeline->overview_3;
    }

    public function render()
    {
        return view('livewire.solutions.timeline.edit')->extends('layouts.panel');
    }
}
