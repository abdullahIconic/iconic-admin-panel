<?php

namespace App\Http\Livewire\Industries\Solutions;

use App\Helper\Thumbnail;
use App\Models\Industry;
use App\Models\IndustrySolution;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Edit extends Component
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

    public $solution;
    public $industries = [];
    public $authors = [];

    public function mount(IndustrySolution $solution)
    {
        // Solution Data
        $this->visible = $solution->visible;
        $this->isFeatured = $solution->isFeatured;
        $this->industry_id = $solution->industry_id;
        $this->authored_by = $solution->authored_by;
        $this->title = $solution->title;
        $this->url = $solution->url;
        $this->article = $solution->article;
        $this->description = $solution->description;
        $this->meta_title = $solution->meta_title;
        $this->meta_description = $solution->meta_description;
        $this->meta_keywords = $solution->meta_keywords;

        $this->solution = $solution;
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

    public function update()
    {
        $this->solution->update([
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
            "updated_at" => now(),
        ]);

        // Checking for sample
        if ($this->image) {

            // Deleting existing image
            Storage::delete($this->solution->image);
            Storage::delete($this->solution->image_medium);
            Storage::delete($this->solution->image_small);

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
            $path = "industries/" . $this->solution->url;
            $thumbnail = Thumbnail::make($this->image, $dimension, $path);

            // Updating Image Paths
            $this->solution->update([
                "image" => $thumbnail['image'],
                "image_medium" => $thumbnail['image_medium'],
                "image_small" => $thumbnail['image_small'],
                "updated_by" => auth()->id(),
                "updated_at" => now(),
            ]);
        }

        return redirect(route('industries.solutions.index'));
    }

    public function render()
    {
        return view('livewire.industries.industry-solutions.edit')->extends('layouts.panel');
    }
}
