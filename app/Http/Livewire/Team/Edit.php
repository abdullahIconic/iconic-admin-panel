<?php

namespace App\Http\Livewire\Team;

use Livewire\Component;
use Str;
use App\Models\Team;

class Edit extends Component
{
    public
        $team,
        $visible = 1,
        $expert,
        $expert_in,
        $name,
        $designation,
        $overview,
        $email,
        $phone,
        $facebook,
        $twitter,
        $linkedin,
        $support,
         $contact,
        $contact_url,
        $support_text,
        $button_text
    ;

    public function mount(Team $team)
    {
        $this->team = $team;

        $this->visible = $team->visible;
        $this->expert = $team->expert;
        $this->expert_in = $team->expert_in;
        $this->name = $team->name;
        $this->designation = $team->designation;
        $this->overview = $team->overview;
        $this->email = $team->email;
        $this->phone = $team->phone;
        $this->facebook = $team->facebook;
        $this->twitter = $team->twitter;
        $this->linkedin = $team->linkedin;
        $this->support = $team->support;
        $this->contact = $team->contact;
        $this->contact_url = $team->contact_url;
        $this->support_text = $team->support_text;
        $this->button_text = $team->button_text;
    }

    public function render()
    {
        return view('livewire.team.edit')->extends('layouts.panel');
    }
}