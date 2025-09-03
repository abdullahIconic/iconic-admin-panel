<?php

namespace App\Http\Livewire\Products\Segments\Solutions;

use App\Helper\Thumbnail;
use App\Models\Industry;
use App\Models\IndustrySolution;
use App\Models\ProductSegment;
use App\Models\SegmentSolution;
use App\Models\Team;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
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

    public $product_segments = [];
    public $authors = [];

    public function mount()
    {
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

    public function store()
    {
        $industry = SegmentSolution::create([
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
            $path = "products/segments/solutions/" . $industry->url;
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

        return redirect(route('products.segments.solutions.index'));
    }

    public function render()
    {
        return view('livewire.products.segments.segment-solutions.create')->extends('layouts.panel');
    }
}
