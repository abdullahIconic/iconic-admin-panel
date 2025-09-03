<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Str;
use App\Models\Siteinfo;

class SiteInformations extends Component
{
    public
        $info,
        $organization,
        $mobile,
        $email,
        $facebook,
        $twitter,
        $linkedin,
        $pinterest,
        $youtube,
        $whatsapp,
        $instagram,
        $tumblr,
        $portfolio,
        $address,
        $address2,
        $address3
    ;

    public function mount()
    {
        $info = Siteinfo::find(1);
        $this->info = $info;

        $this->organization = $info->organization;
        $this->mobile = $info->mobile;
        $this->email = $info->email;
        $this->facebook = $info->facebook;
        $this->twitter = $info->twitter;
        $this->linkedin = $info->linkedin;
        $this->pinterest = $info->pinterest;
        $this->youtube = $info->youtube;
        $this->whatsapp = $info->whatsapp;
        $this->instagram = $info->instagram;
        $this->tumblr = $info->tumblr;
        $this->portfolio = $info->portfolio;
        $this->address = $info->address;
        $this->address2 = $info->address2;
        $this->address = $info->address3;
    }

    public function update()
    {
        $this->info->update([
            "organization" => $this->organization,
            "mobile" => $this->mobile,
            "email" => $this->email,
            "facebook" => $this->facebook,
            "twitter" => $this->twitter,
            "linkedin" => $this->linkedin,
            "pinterest" => $this->pinterest,
            "youtube" => $this->youtube,
            "whatsapp" => $this->whatsapp,
            "instagram" => $this->instagram,
            "tumblr" => $this->tumblr,
            "portfolio" => $this->portfolio,
            "address" => $this->address,
            "address2" => $this->address2,
            "address" => $this->address,
        ]);

        return back()->with('success', 'Success!');
    }

    public function render()
    {
        return view('livewire.siteinfos')->extends('layouts.panel');
    }
}