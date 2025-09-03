<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Http\Requests\StoreSolutionRequest;
use App\Http\Requests\UpdateSolutionRequest;
use App\Models\Solution;
use Illuminate\Support\Facades\Storage;

class SolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.solutions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.solutions.create');
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
            $path = "solutions";
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
     * @param  \App\Http\Requests\StoreSolutionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSolutionRequest $request)
    {
        $request->validate([
            'visible' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'url' => 'required|unique:solutions',
            'description' => 'required',
            'article' => 'required',
            'image' => 'required|image',
        ]);
   
        $solution = Solution::create([
            'visible' => $request->visible,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
            'article' => $request->article,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($solution, $request);

        return back()->with('success', 'Stored!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function show(Solution $solution)
    {
        return view('panel.solutions.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function edit(Solution $solution)
    {
        return view('panel.solutions.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSolutionRequest  $request
     * @param  \App\Models\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSolutionRequest $request, Solution $solution)
    {
        $request->validate([    
            'visible' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'url' => 'required',
            'description' => 'required',
            'article' => 'required',
            'image' => 'nullable|image',
        ]);
    
        // Checking Url Existance
        if ($solution->url != $request->url) {
            $request->validate([
                'url' => 'unique:solutions',
            ]);
        }
    
        $solution->update([
            'visible' => $request->visible,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
            'article' => $request->article,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($solution, $request);
   
        return back()->with('status', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solution $solution)
    {
        
        Storage::delete($solution->image);
        Storage::delete($solution->image_medium);
        Storage::delete($solution->image_small);

        $solution->delete();

        return back()->with('status', 'Deleted!');
    }
}
