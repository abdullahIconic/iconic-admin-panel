<?php

namespace App\Http\Livewire\Products\Segments\Projects;

use App\Helper\Thumbnail;
use App\Models\ProductSegment;
use App\Models\SegmentProject;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public
        $visible = 1,
        $isFeatured = 0,
        $product_segment_id,
        $authored_by,
        $title,
        $url,
        $article,
        $description,
        $meta_title,
        $meta_description,
        $meta_keywords,
        $image;

    public $project;
    public $product_segments = [];
    public $authors = [];

    public function mount(SegmentProject $project)
    {
        // Solution Data
        $this->visible = $project->visible;
        $this->isFeatured = $project->isFeatured;
        $this->product_segment_id = $project->product_segment_id;
        $this->authored_by = $project->authored_by;
        $this->title = $project->title;
        $this->url = $project->url;
        $this->article = $project->article;
        $this->description = $project->description;
        $this->meta_title = $project->meta_title;
        $this->meta_description = $project->meta_description;
        $this->meta_keywords = $project->meta_keywords;

        $this->project = $project;
        $this->product_segments = ProductSegment::where('visible', 1)
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
        $this->project->update([
            "visible" => $this->visible,
            "isFeatured" => $this->isFeatured,
            "product_segment_id" => $this->product_segment_id,
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
            Storage::delete($this->project->image);
            Storage::delete($this->project->image_medium);
            Storage::delete($this->project->image_small);

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
            $path = "products/segments/projects/" . $this->project->url;
            $thumbnail = Thumbnail::make($this->image, $dimension, $path);

            // Updating Image Paths
            $this->project->update([
                "image" => $thumbnail['image'],
                "image_medium" => $thumbnail['image_medium'],
                "image_small" => $thumbnail['image_small'],
                "updated_by" => auth()->id(),
                "updated_at" => now(),
            ]);
        }

        return redirect(route('products.segments.projects.index'));
    }

    public function render()
    {
        return view('livewire.products.segments.segment-projects.edit')->extends('layouts.panel');
    }
}
