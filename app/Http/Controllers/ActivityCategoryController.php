<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityCategoryRequest;
use App\Http\Requests\UpdateActivityCategoryRequest;
use App\Models\ActivityCategory;

class ActivityCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ActivityCategory::all();
        return view('panel.activity.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.activity.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActivityCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivityCategoryRequest $request)
    {
        ActivityCategory::create([
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

        return back()->with('success', 'Stored!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActivityCategory  $activityCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityCategory $activityCategory)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActivityCategory  $activityCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivityCategory $activityCategory)
    {
        return view('panel.activity.category.edit', ['category' => $activityCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActivityCategoryRequest  $request
     * @param  \App\Models\ActivityCategory  $activityCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActivityCategoryRequest $request, ActivityCategory $activityCategory)
    {
        $activityCategory->update([
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

        return back()->with('success', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActivityCategory  $activityCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityCategory $activityCategory)
    {
        $activityCategory->delete();
        return back()->with('success', 'Deleted!');
    }
}
