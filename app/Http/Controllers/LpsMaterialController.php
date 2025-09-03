<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Http\Requests\StoreLpsMaterialRequest;
use App\Http\Requests\UpdateLpsMaterialRequest;
use App\Models\LpsMaterial;
use Illuminate\Support\Facades\Storage;

class LpsMaterialController extends Controller
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
            $path = "services/lps/materials";
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
     * @param  \App\Http\Requests\StoreLpsMaterialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLpsMaterialRequest $request)
    {
        $lpsMaterial = LpsMaterial::create([
            "visible" => $request->visible,
            "title" => $request->title,
            "material_for" => $request->material_for,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($lpsMaterial, $request);

        return redirect(route('lps.materials.index'))->with('success', 'Stored!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLpsMaterialRequest  $request
     * @param  \App\Models\LpsMaterial  $lpsMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLpsMaterialRequest $request, LpsMaterial $material)
    {
        $material->update([
            "visible" => $request->visible,
            "title" => $request->title,
            "material_for" => $request->material_for,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($material, $request);
   
        return redirect(route('lps.materials.index'))->with('status', 'Updated!');
    }
}
