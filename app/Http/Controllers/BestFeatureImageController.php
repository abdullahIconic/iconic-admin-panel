<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Models\BestFeatureImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BestFeatureImageController extends Controller
{
    /**
     * Checking for assets
     */
    public function assetsChecker($entry, $request)
    {
        // Checking for sample
        if($request->hasFile('image')){

            // Deleting existing image
            Storage::delete($entry->image);
            Storage::delete($entry->image_medium);
            Storage::delete($entry->image_small);

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
            $path = "services/best-features";
            $thumbnail = Thumbnail::make($request->image, $dimension, $path);

            // Updating Image Paths
            $entry->update([
                "image" => $thumbnail['image'],
                "image_medium" => $thumbnail['image_medium'],
                "image_small" => $thumbnail['image_small'],
                "updated_by" => auth()->id(),
                "updated_at" => now(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bestFeatureImage = BestFeatureImage::create([
            'visible' => $request->visible,
            'page' => $request->page,
            'title' => $request->title,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($bestFeatureImage, $request);

        return back()->with('success', 'Stored!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BestFeatureImage  $bestFeatureImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BestFeatureImage $bestFeatureImage)
    {
        $bestFeatureImage->update([
            'visible' => $request->visible,
            'page' => $request->page,
            'title' => $request->title,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($bestFeatureImage, $request);
    
        return back()->with('success', 'Updated!');
    }
}
