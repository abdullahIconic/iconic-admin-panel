<?php

namespace App\Http\Livewire\Industries;

use App\Helper\Thumbnail;
use App\Models\Industry;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;
use App\Models\ServiceCategory as Category;

class Edit extends Component
{
    use WithFileUploads;

    public $categories = [];

    public
        $industry,
        $visible,
        $category,
        $title,
        $url,
        $slogan,
        $article,
        $meta_title,
        $description,
        $overview,
        $solution_overview,
        $project_overview,
        $meta_description,
        $meta_keywords,
        $image;

    public function mount(Industry $industry)
    {
        // Product Data
        $this->industry = $industry;
        $this->visible = $industry->visible;
        $this->category = $industry->category_id;
        $this->title = $industry->title;
        $this->url = $industry->url;
        $this->slogan = $industry->slogan;
        $this->article = $industry->article;
        $this->meta_title = $industry->meta_title;
        $this->description = $industry->description;
        $this->overview = $industry->overview;
        $this->solution_overview = $industry->solution_overview;
        $this->project_overview = $industry->project_overview;
        $this->meta_description = $industry->meta_description;
        $this->meta_keywords = $industry->meta_keywords;

        $this->categories = Category::where('visible', 1)->where('type', 'industry')->get();
    }

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function update()
    {
        $this->industry->update([
            "visible" => $this->visible,
            "category_id" => $this->category,
            "title" => $this->title,
            "url" => $this->url,
            "slogan" => $this->slogan,
            "article" => $this->article,
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
            Storage::delete($this->industry->image);
            Storage::delete($this->industry->image_medium);
            Storage::delete($this->industry->image_small);

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
            $path = "products/industries/" . $this->industry->url;
            $thumbnail = Thumbnail::make($this->image, $dimension, $path);

            // Updating Image Paths
            $this->industry->update([
                "image" => $thumbnail['image'],
                "image_medium" => $thumbnail['image_medium'],
                "image_small" => $thumbnail['image_small'],
                "updated_by" => auth()->id(),
                "updated_at" => now(),
            ]);
        }

        return redirect(route('industries.index'));
    }

    public function render()
    {
        return view('livewire.industries.edit')->extends('layouts.panel');
    }
}
