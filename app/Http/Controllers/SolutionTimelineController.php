<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Http\Requests\StoreSolutionTimelineRequest;
use App\Http\Requests\UpdateSolutionTimelineRequest;
use App\Models\SolutionTimeline;
use Illuminate\Support\Facades\Storage;

class SolutionTimelineController extends Controller
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
            $path = "solutions/timeline";
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
     * @param  \App\Http\Requests\StoreSolutionTimelineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSolutionTimelineRequest $request)
    {
        $item = SolutionTimeline::create([
            "visible" => $request->visible,
            "title_1" => $request->title_1,
            "overview_1" => $request->overview_1,
            "title_2" => $request->title_2,
            "overview_2" => $request->overview_2,
            "title_3" => $request->title_3,
            "overview_3" => $request->overview_3,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($item, $request);

        return redirect(route('solutions.timeline.index'))->with('success', 'Stored!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSolutionTimelineRequest  $request
     * @param  \App\Models\SolutionTimeline  $solutionTimeline
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSolutionTimelineRequest $request, SolutionTimeline $timeline)
    {
        $timeline->update([
            "title_1" => $request->title_1,
            "overview_1" => $request->overview_1,
            "title_2" => $request->title_2,
            "overview_2" => $request->overview_2,
            "title_3" => $request->title_3,
            "overview_3" => $request->overview_3,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($timeline, $request);
   
        return redirect(route('solutions.timeline.index'))->with('status', 'Updated!');
    }
}
