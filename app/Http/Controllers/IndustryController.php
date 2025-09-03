<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreIndustryRequest;
use App\Http\Requests\UpdateIndustryRequest;
use App\Models\IndustryCategory;

class IndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $industries = Industry::all();
        
        return view('panel.product.industries.index', ['industries' => $industries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = IndustryCategory::where('visible', 1)->get();
  
        return view('panel.product.industries.create',['categories' => $categories]);
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
            $path = "industries";
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
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $industry = Industry::create([
            'category_id' => $request->category,
            "slogan" => $request->slogan,
            "position" => $request->position,
            "visible" => $request->visible,
            "title" => $request->title,
            "url" => $request->url,
            "article" => $request->article,
            "description" => $request->description,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        $this->assetsChecker($industry, $request);

        return back()->with('status', 'Stored!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function show(Industry $industry)
    {
        return view('panel.product.industry.show', ['industry' => $industry]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function edit(Industry $industry)
    {
        $categories = IndustryCategory::where('visible', 1)->get();
        
        return view('panel.product.industry.edit', ['industry' => $industry, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Industry $industry)
    {
        $industry->update([
            'category_id' => $request->category,
            'slogan' => $request->slogan,
            "position" => $request->position,
            "visible" => $request->visible,
            "title" => $request->title,
            "url" => $request->url,
            'article' => $request->article,
            "description" => $request->description,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        $this->assetsChecker($industry, $request);
    
        return back()->with('status', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Industry $industry)
    {
        Storage::delete($industry->image);
        Storage::delete($industry->image_medium);
        Storage::delete($industry->image_small);

        $industry->delete();

        return back()->with('status', 'Deleted!');
    }
}
