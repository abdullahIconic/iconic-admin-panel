<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIndustrySolutionRequest;
use App\Http\Requests\UpdateIndustrySolutionRequest;
use App\Helper\Thumbnail;
use App\Models\Industry;
use App\Models\IndustrySolution;
use Illuminate\Support\Facades\Storage;

class IndustrySolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solutions = IndustrySolution::all();
        return view('panel.industries.industry-solutions.index', ['solutions' => $solutions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.industries.industry-solutions.create');
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
     * @param  \App\Http\Requests\StoreIndustrySolutionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIndustrySolutionRequest $request)
    {
        $industry = IndustrySolution::create([
            "visible" => $request->visible,
            "isFeatured" => $request->isFeatured,
            "industry_id" => $request->industry_id,
            "authored_by" => $request->authored_by,
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

        // Assets checker
        $this->assetsChecker($industry, $request);

        return redirect('/industries/solutions')->with('status', 'Stored!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IndustrySolution  $solution
     * @return \Illuminate\Http\Response
     */
    public function show(IndustrySolution $solution)
    {
        return view('panel.industries.industry-solutions.show', ['solution' => $solution]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndustrySolution  $solution
     * @return \Illuminate\Http\Response
     */
    public function edit(IndustrySolution $solution)
    {
        $industries = Industry::where('visible', 1)->get();
        return view('panel.industries.industry-solutions.edit', ['solution' => $solution, 'industries' => $industries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIndustrySolutionRequest $request
     * @param  \App\Models\IndustrySolution  $solution
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIndustrySolutionRequest $request, IndustrySolution $solution)
    {
        $solution->update([
            "visible" => $request->visible,
            "isFeatured" => $request->isFeatured,
            "industry_id" => $request->industry_id,
            "authored_by" => $request->authored_by,
            "title" => $request->title,
            "url" => $request->url,
            "article" => $request->article,
            "description" => $request->description,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($solution, $request);
        return redirect('/industries/solutions')->with('status', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IndustrySolution  $solution
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndustrySolution $solution)
    {
        // Deleting old image
        Storage::delete($solution->image);
        Storage::delete($solution->image_medium);
        Storage::delete($solution->image_small);

        $solution->delete();
        return redirect('/industries/solutions')->with('status', 'Deleted!');
    }
}
