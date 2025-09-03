<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductSegmentRequest;
use App\Http\Requests\UpdateProductSegmentRequest;
use App\Models\ProductSegment;
use Storage;
use App\Helper\Thumbnail;

class ProductSegmentController extends Controller
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
            $path = "services";
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

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \App\Http\Requests\StoreProductSegmentRequest  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(StoreProductSegmentRequest $request)
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductSegmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductSegmentRequest $request)
    {
        // dd($request->all());
        $request->validate([
            'visible' => 'required',
            'category' => 'required',
            'title' => 'required',
            'url' => 'required|unique:product_segments',
            'article' => 'required',
            'description' => 'required',
            'overview' => 'required',
            'solution_overview' => 'required',
            'image' => 'required|image',
        ]);

        $segment = ProductSegment::create([
            'visible' => $request->visible,
            // 'highlighted' => $request->highlighted,
            // 'position' => $request->position,
            'category_id' => $request->category,
            // 'slogan' => $request->slogan,
            'title' => $request->title,
            'url' => $request->url,
            'article' => $request->article,
            "description" => $request->description,
            "overview" => $request->overview,
            "solution_overview" => $request->solution_overview,
            "project_overview" => $request->project_overview,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($segment, $request);

        return redirect(route('products.segments.index'))->with('success', 'Stored!');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductSegment  $productSegment
     * @return \Illuminate\Http\Response
     */
    public function show(ProductSegment $productSegment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductSegment  $productSegment
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductSegment $productSegment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductSegmentRequest  $request
     * @param  \App\Models\ProductSegment  $productSegment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductSegmentRequest $request, ProductSegment $segment)
    {
        $request->validate([
            'visible' => 'required',
            'category' => 'required',
            'title' => 'required',
            'url' => 'required',
            'article' => 'required',
            'description' => 'required',
            'overview' => 'required',
            'solution_overview' => 'required',
            'image' => 'nullable|image',
        ]);

        // dd($segment , $request->url);

        // Checking Url Existance
        if ($segment->url != $request->url) {
            $request->validate([
                'url' => 'unique:product_segments',
            ]);
        }

        $segment->update([
            'visible' => $request->visible,
            // 'highlighted' => $request->highlighted,
            // 'position' => $request->position,
            'category_id' => $request->category,
            // 'slogan' => $request->slogan,
            'title' => $request->title,
            'url' => $request->url,
            'article' => $request->article,
            "description" => $request->description,
            "overview" => $request->overview,
            "solution_overview" => $request->solution_overview,
            "project_overview" => $request->project_overview,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($segment, $request);

        return redirect(route('products.segments.index'))->with('success', 'Stored!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductSegment  $productSegment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSegment $productSegment)
    {
        //
    }
}