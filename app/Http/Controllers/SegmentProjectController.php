<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSegmentProjectRequest;
use App\Http\Requests\UpdateSegmentProjectRequest;
use App\Helper\Thumbnail;
use App\Models\SegmentProject;
use Illuminate\Support\Facades\Storage;

class SegmentProjectController extends Controller
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
            $path = "industries";
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
     * @param  \App\Http\Requests\StoreSegmentProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSegmentProjectRequest $request)
    {
        $industry = SegmentProject::create([
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

        return redirect('/products/segments/projects')->with('status', 'Stored!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSegmentProjectRequest $request
     * @param  \App\Models\SegmentProject  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSegmentProjectRequest $request, SegmentProject $project)
    {
        $project->update([
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
        $this->assetsChecker($project, $request);

        return redirect('/products/segments/projects')->with('status', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SegmentProject  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(SegmentProject $project)
    {
        // Deleting old image
        Storage::delete($project->image);
        Storage::delete($project->image_medium);
        Storage::delete($project->image_small);

        $project->delete();
        return redirect('/products/segments/projects')->with('status', 'Deleted!');
    }
}
