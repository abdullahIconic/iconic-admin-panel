<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Models\ProductPromotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductPromotionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.products.promotions.create');
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
            $path = "product-promotions";
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
    public function store(Request $request)
    {
        $promotion = ProductPromotion::create([
            "visible" => $request->visible,
            "title" => $request->title,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        $this->assetsChecker($promotion, $request);
  
        return redirect(route('products.promotions.index'))->with('success', 'Stored!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductPromotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductPromotion $promotion)
    {
        return view('panel.products.promotions.edit', ['promotion' => $promotion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductPromotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductPromotion $promotion)
    {
        $promotion->update([
            "visible" => $request->visible,
            "title" => $request->title,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        $this->assetsChecker($promotion, $request);
    
        return redirect(route('products.promotions.index'))->with('success', 'Updated!');
    }
}
