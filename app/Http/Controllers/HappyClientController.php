<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Http\Requests\StoreHappyClientRequest;
use App\Http\Requests\UpdateHappyClientRequest;
use App\Models\HappyClient;
use Illuminate\Support\Facades\Storage;

class HappyClientController extends Controller
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
            $path = "happy-clients";
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
     * @param  \App\Http\Requests\StoreHappyClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHappyClientRequest $request)
    {
        $happyClient = HappyClient::create([
            "visible" => $request->visible,
            "happy_for" => $request->happy_for,
            "name" => $request->name,
            "designation" => $request->designation,
            "company" => $request->company,
            "comment" => $request->comment,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        $this->assetsChecker($happyClient, $request);
  
        return redirect(route('happy-clients.index'))->with('success', 'Stored!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHappyClientRequest  $request
     * @param  \App\Models\HappyClient  $happyClient
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHappyClientRequest $request, HappyClient $happyClient)
    {
        $happyClient->update([
            "visible" => $request->visible,
            "happy_for" => $request->happy_for,
            "name" => $request->name,
            "designation" => $request->designation,
            "company" => $request->company,
            "comment" => $request->comment,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        $this->assetsChecker($happyClient, $request);
    
        return redirect(route('happy-clients.index'))->with('success', 'Updated!');
    }
}
