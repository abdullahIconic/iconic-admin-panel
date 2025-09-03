<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Http\Requests\StoreOfferBannerRequest;
use App\Http\Requests\UpdateOfferBannerRequest;
use App\Models\OfferBanner;
use Illuminate\Support\Facades\Storage;

class OfferBannerController extends Controller
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
            $path = "offers/banners";
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
     * @param  \App\Http\Requests\StoreOfferBannerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOfferBannerRequest $request)
    {
        $offerBanner = OfferBanner::create([
            "visible" => $request->visible,
            "title" => $request->title,
            "url" => $request->url,
            "label" => $request->label,
            "overview" => $request->overview,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($offerBanner, $request);

        return redirect(route('offers.banners.index'))->with('success', 'Stored!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOfferBannerRequest  $request
     * @param  \App\Models\OfferBanner  $offerBanner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOfferBannerRequest $request, OfferBanner $offerBanner)
    {
        $offerBanner->update([
            "visible" => $request->visible,
            "title" => $request->title,
            "url" => $request->url,
            "label" => $request->label,
            "overview" => $request->overview,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($offerBanner, $request);
   
        return redirect(route('offers.banners.index'))->with('status', 'Updated!');
    }
}
