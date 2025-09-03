<?php

namespace App\Http\Livewire\Team;

use Livewire\Component;
use Str;
use App\Models\Team;

class Create extends Component
{
    public
        $visible = 1,
        $expert = 0,
        $expert_in,
        $name,
        $designation,
        $overview,
        $email,
        $phone,
        $facebook,
        $twitter,
        $linkedin,
        $support=0,
        $contact=0,
        $contact_url,
        $button_text,
        $support_text
    ;

    public function render()
    {
        return view('livewire.team.create')->extends('layouts.panel');
    }
}