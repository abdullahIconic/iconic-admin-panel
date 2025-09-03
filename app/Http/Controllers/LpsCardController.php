<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Http\Requests\StoreLpsCardRequest;
use App\Http\Requests\UpdateLpsCardRequest;
use App\Models\LpsCard;
use Illuminate\Support\Facades\Storage;

class LpsCardController extends Controller
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
            $path = "services/lps/cards";
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
     * @param  \App\Http\Requests\StoreLpsCardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLpsCardRequest $request)
    {
        $card = LpsCard::create([
            "visible" => $request->visible,
            "title" => $request->title,
            "url" => $request->url,
            "page_name" => $request->page_name,
            "card_for" => $request->card_for,
            "card_type" => $request->card_type,
            "overview" => $request->overview,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($card, $request);

        return redirect(route('lps.cards.index'))->with('success', 'Stored!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLpsCardRequest  $request
     * @param  \App\Models\LpsCard  $lpsCard
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLpsCardRequest $request, LpsCard $card)
    {
        $card->update([
            "visible" => $request->visible,
            "title" => $request->title,
            "url" => $request->url,
            "page_name" => $request->page_name,
            "card_for" => $request->card_for,
            "card_type" => $request->card_type,
            "overview" => $request->overview,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($card, $request);
   
        return redirect(route('lps.cards.index'))->with('status', 'Updated!');
    }
}
