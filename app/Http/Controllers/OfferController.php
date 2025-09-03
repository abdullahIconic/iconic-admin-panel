<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Models\Offer;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->check() && auth()->user()->role != 0){
            $offers = Offer::orderBy('id', 'desc')->get();
        }else{
            $offers = Offer::where('status', 1)->where('starting_date', '<=', now())->where('ending_date', '>=', now())->get();
        }
        return view('panel.offers.index', compact('offers'));
    }

    
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
            $path = "offers";
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
     * @param  \App\Http\Requests\StoreOfferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOfferRequest $request)
    {
        $offer = Offer::create([
            "visible" => $request->visible,
            "regular_price" => $request->regular_price,
            "price" => $request->price,
            "discount" => $request->discount,
            "title" => $request->title,
            "url" => $request->url,
            "overview" => $request->overview,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "starting_date" => $request->starting_date,
            "ending_date" => $request->ending_date,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($offer, $request);

        return redirect(route('offers.index'))->with('success', 'Stored!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOfferRequest  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        $offer->update([
            "visible" => $request->visible,
            "regular_price" => $request->regular_price,
            "price" => $request->price,
            "discount" => $request->discount,
            "title" => $request->title,
            "url" => $request->url,
            "overview" => $request->overview,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "starting_date" => $request->starting_date,
            "ending_date" => $request->ending_date,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($offer, $request);
   
        return redirect(route('offers.index'))->with('status', 'Updated!');
    }
}
