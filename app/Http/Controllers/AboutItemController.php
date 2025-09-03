<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Http\Requests\StoreAboutItemRequest;
use App\Http\Requests\UpdateAboutItemRequest;
use App\Models\AboutItem;
use Illuminate\Support\Facades\Storage;

class AboutItemController extends Controller
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
            $path = "about/items";
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
     * @param  \App\Http\Requests\StoreAboutItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAboutItemRequest $request)
    {
        $item = AboutItem::create([
            "visible" => $request->visible,
            "title" => $request->title,
            "url" => $request->url,
            "description" => $request->description,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($item, $request);

        return redirect(route('about.items.index'))->with('success', 'Stored!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAboutItemRequest  $request
     * @param  \App\Models\AboutItem  $aboutItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAboutItemRequest $request, AboutItem $item)
    {
        $item->update([
            "visible" => $request->visible,
            "title" => $request->title,
            "url" => $request->url,
            "description" => $request->description,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($item, $request);
   
        return redirect(route('about.items.index'))->with('status', 'Updated!');
    }
}
