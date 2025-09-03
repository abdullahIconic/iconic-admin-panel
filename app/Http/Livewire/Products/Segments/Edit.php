<?php

namespace App\Http\Livewire\Products\Segments;

use App\Helper\Thumbnail;
use Livewire\Component;
use Str;
use App\Models\ProductSegment as Segment;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\ServiceCategory as Category;

class Edit extends Component
{
    use WithFileUploads;
    
    public $categories = [];

    public
        $segment,
        $visible,
        $category,
        $title,
        $url,
        $meta_title,
        $article,
        $description,
        $overview,
        $solution_overview,
        $project_overview,
        $meta_description,
        $meta_keywords,
        $image;

    public function mount(Segment $segment)
    {
        // Product Data
        $this->segment = $segment;
        $this->visible = $segment->visible;
        $this->category = $segment->category_id;
        $this->title = $segment->title;
        $this->url = $segment->url;
        $this->meta_title = $segment->meta_title;
        $this->article = $segment->article;
        $this->description = $segment->description;
        $this->overview = $segment->overview;
        $this->solution_overview = $segment->solution_overview;
        $this->project_overview = $segment->project_overview;
        $this->meta_description = $segment->meta_description;
        $this->meta_keywords = $segment->meta_keywords;

        $this->categories = Category::where('visible', 1)->where('type', 'segment')->get();
    }

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function update()
    {
        $this->segment->update([
            "visible" => $this->visible,
            "category_id" => $this->category,
            "title" => $this->title,
            "url" => $this->url,
            "meta_title" => $this->meta_title,
            "description" => $this->description,
            "overview" => $this->overview,
            "solution_overview" => $this->solution_overview,
            "project_overview" => $this->project_overview,
            "meta_description" => $this->meta_description,
            "meta_keywords" => $this->meta_keywords,
            "updated_by" => auth()->id(),
            "updated_at" => now(),
        ]);

        // Checking for sample
        if ($this->image) {

            // Deleting existing image
            Storage::delete($this->segment->image);
            Storage::delete($this->segment->image_medium);
            Storage::delete($this->segment->image_small);

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
            $path = "products/segments/" . $this->segment->url;
            $thumbnail = Thumbnail::make($this->image, $dimension, $path);

            // Updating Image Paths
            $this->segment->update([
                "image" => $thumbnail['image'],
                "image_medium" => $thumbnail['image_medium'],
                "image_small" => $thumbnail['image_small'],
                "updated_by" => auth()->id(),
                "updated_at" => now(),
            ]);
        }

        return redirect(route('products.segments.index'));
    }

    public function render()
    {
        return view('livewire.products.segments.edit')->extends('layouts.panel');
    }
}
