<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSegmentSolutionRequest;
use App\Http\Requests\UpdateSegmentSolutionRequest;
use App\Helper\Thumbnail;
use App\Models\IndustrySolution;
use App\Models\SegmentSolution;
use Illuminate\Support\Facades\Storage;

class SegmentSolutionController extends Controller
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
            $path = "products/segments/solutions/";
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
     * @param  \App\Http\Requests\StoreSegmentSolutionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSegmentSolutionRequest $request)
    {
        $industry = SegmentSolution::create([
            "visible" => $request->visible,
            "isFeatured" => $request->isFeatured,
            "product_segment_id" => $request->product_segment_id,
            "authored_by" => $request->authored_by,
            "title" => $request->title,
            "url" => $request->url,
            "article" => $request->article,
            "description" => $request->description,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($industry, $request);

        return redirect('/products/segments/solutions')->with('status', 'Stored!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSegmentSolutionRequest $request
     * @param  \App\Models\SegmentSolution  $solution
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSegmentSolutionRequest $request, SegmentSolution $solution)
    {
        $solution->update([
            "visible" => $request->visible,
            "isFeatured" => $request->isFeatured,
            "product_segment_id" => $request->product_segment_id,
            "authored_by" => $request->authored_by,
            "title" => $request->title,
            "url" => $request->url,
            "article" => $request->article,
            "description" => $request->description,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($solution, $request);
        return redirect('/products/segments/solutions')->with('status', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SegmentSolution  $solution
     * @return \Illuminate\Http\Response
     */
    public function destroy(SegmentSolution $solution)
    {
        // Deleting old image
        Storage::delete($solution->image);
        Storage::delete($solution->image_medium);
        Storage::delete($solution->image_small);

        $solution->delete();
        return redirect('/products/segments/solutions')->with('status', 'Deleted!');
    }
}
