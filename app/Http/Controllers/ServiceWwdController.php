<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Http\Requests\StoreServiceWwdRequest;
use App\Http\Requests\UpdateServiceWwdRequest;
use App\Models\ServiceWwd;
use Illuminate\Support\Facades\Storage;

class ServiceWwdController extends Controller
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
            $path = "services/what-we-delivered";
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
     * @param  \App\Http\Requests\StoreServiceWwdRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceWwdRequest $request)
    {
        $work = ServiceWwd::create([
            "visible" => $request->visible,
            "title" => $request->title,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($work, $request);

        return redirect(route('services.what-we-delivered.index'))->with('success', 'Stored!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceWwdRequest  $request
     * @param  \App\Models\ServiceWwd  $serviceWwd
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceWwdRequest $request, ServiceWwd $what_we_delivered)
    {
        $what_we_delivered->update([
            "visible" => $request->visible,
            "title" => $request->title,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($what_we_delivered, $request);
   
        return redirect(route('services.what-we-delivered.index'))->with('status', 'Updated!');
    }
}
