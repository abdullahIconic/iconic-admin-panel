<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIndustryProjectRequest;
use App\Http\Requests\UpdateIndustryProjectRequest;
use App\Helper\Thumbnail;
use App\Models\Industry;
use App\Models\IndustryProject;
use Illuminate\Support\Facades\Storage;

class IndustryProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = IndustryProject::all();
        return view('panel.industries.industry-projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.industries.industry-projects.create');
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
     * @param  \App\Http\Requests\StoreIndustryProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIndustryProjectRequest $request)
    {
        $industry = IndustryProject::create([
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

        return redirect('/industries/projects')->with('status', 'Stored!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IndustryProject  $project
     * @return \Illuminate\Http\Response
     */
    public function show(IndustryProject $project)
    {
        return view('panel.industries.industry-projects.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndustryProject $project
     * @return \Illuminate\Http\Response
     */
    public function edit(IndustryProject $project)
    {
        $industries = Industry::where('visible', 1)->get();
        return view('panel.industries.industry-projects.edit', ['project' => $project, 'industries' => $industries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIndustryProjectRequest $request
     * @param  \App\Models\IndustryProject  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIndustryProjectRequest $request, IndustryProject $project)
    {
        $project->update([
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
        $this->assetsChecker($project, $request);

        return redirect('/industries/projects')->with('status', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IndustryProject  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndustryProject $project)
    {
        // Deleting old image
        Storage::delete($project->image);
        Storage::delete($project->image_medium);
        Storage::delete($project->image_small);

        $project->delete();
        return redirect('/industries/projects')->with('status', 'Deleted!');
    }
}
