<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Http\Requests\StoreGeowthPathRequest;
use App\Http\Requests\UpdateGeowthPathRequest;
use App\Models\GrowthPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GrowthPathController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

      public function assetsChecker($entry, $request)
    {
        // Checking for sample
        if ($request->hasFile('image')) {

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
            $path = "clients";
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
      public function store(StoreGeowthPathRequest $request)
    {
        $growthPath = GrowthPath::create([
            "visible" => $request->visible,
            "title" => $request->title,
             "year" => $request->year,
            "description" => $request->description,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($growthPath, $request);

        return redirect()->back()->with('success', 'Stored!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGeowthPathRequest $request, GrowthPath $growthpath)
    {
        $growthpath->update([
            "visible" => $request->visible,
            "title" => $request->title,
            "year" => $request->year,
           "description" => $request->description,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($growthpath, $request);

        return redirect(route('growthpaths.index'))->with('status', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
