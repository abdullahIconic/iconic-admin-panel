<?php

namespace App\Http\Livewire\Industries;

use App\Helper\Thumbnail;
use App\Models\Industry;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;
use App\Models\ServiceCategory as Category;

class Create extends Component
{
    use WithFileUploads;

    public
        $visible = 1,
        $category,
        $slogan,
        $article,
        $title,
        $url,
        $meta_title,
        $description,
        $overview,
        $solution_overview,
        $project_overview,
        $meta_description,
        $meta_keywords,
        $image;

        public $categories = [];

        public function mount()
        {
            $this->categories = Category::where('visible', 1)->where('type', 'industry')->get();
        }

    public function updatedTitle()
    {
        $this->meta_title = $this->title;
        $this->url = Str::slug($this->title);
    }

    public function store()
    {
        $industry = Industry::create([
            "visible" => $this->visible,
            "title" => $this->title,
            "category_id" => $this->category,
            'slogan' => $this->slogan,
            "url" => $this->url,
            'article' => $this->article,
            "meta_title" => $this->meta_title,
            "description" => $this->description,
            "overview" => $this->overview,
            "solution_overview" => $this->solution_overview,
            "project_overview" => $this->project_overview,
            "meta_description" => $this->meta_description,
            "meta_keywords" => $this->meta_keywords,
            "created_by" => auth()->id(),
            "created_at" => now(),
        ]);

        // Checking for sample
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
            $path = "products/industries/" . $industry->url;
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

        return redirect(route('industries.index'));
    }

    public function render()
    {
        return view('livewire.industries.create')->extends('layouts.panel');
    }
}
