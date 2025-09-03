<?php

namespace App\Http\Livewire\Industries\Projects;

use App\Helper\Thumbnail;
use App\Models\Industry;
use App\Models\IndustryProject;
use App\Models\Team;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public
        $visible = 1,
        $isFeatured = 0,
        $industry_id,
        $authored_by,
        $title,
        $url,
        $article,
        $description,
        $meta_title,
        $meta_description,
        $meta_keywords,
        $image;

    public $industries = [];
    public $authors = [];

    public function mount()
    {
        $this->industries = Industry::where('visible', 1)
            ->get();

        $this->authors = Team::where('visible', 1)
            ->get();
    }
    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function store()
    {
        $industry = IndustryProject::create([
            "visible" => $this->visible,
            "isFeatured" => $this->isFeatured,
            "industry_id" => $this->industry_id,
            "authored_by" => $this->authored_by,
            "title" => $this->title,
            "url" => $this->url,
            "article" => $this->article,
            "description" => $this->description,
            "meta_title" => $this->meta_title,
            "meta_description" => $this->meta_description,
            "meta_keywords" => $this->meta_keywords,
            "created_by" => auth()->id(),
            "created_at" => now(),
        ]);

        if ($this->image) {

            // Thumbnail Maker
            $dimension = [
                'medium' => [
                    'width' => 320,
                    'height' => 180,
                ],
                'small' => [
                    'width' => 240,
                    'height' => 135,
                ]
            ];
            $path = "industries/" . $industry->url;
            $thumbnail = Thumbnail::make($this->image, $dimension, $path);

            // Updating Image Paths
            $industry->update([
                "image" => $thumbnail['image'],
                "image_medium" => $thumbnail['image_medium'],
                "image_small" => $thumbnail['image_small'],
                "updated_by" => auth()->id(),
                "updated_at" => now(),
            ]);
        }

        return redirect(route('industries.projects.index'));
    }

    public function render()
    {
        return view('livewire.industries.industry-projects.create')->extends('layouts.panel');
    }
}
