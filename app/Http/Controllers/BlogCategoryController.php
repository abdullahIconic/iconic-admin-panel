<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogCategoryRequest;
use App\Http\Requests\UpdateBlogCategoryRequest;
use App\Helper\Thumbnail;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Storage;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = BlogCategory::all();
        return view('panel.blog.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.blog.category.create');
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
            $path = "posts";
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
     * @param  \App\Http\Requests\StoreBlogCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogCategoryRequest $request)
    {
        BlogCategory::create([
            "language" => $request->language,
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
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blogCategory)
    {
        return view('panel.blog.category.edit', ['category' => $blogCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $blogCategory)
    {
        return view('panel.blog.category.edit', ['blogCategory' => $blogCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogCategoryRequest  $request
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogCategoryRequest $request, BlogCategory $blogCategory)
    {
        $blogCategory->update([
            "language" => $request->language,
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
   
        return back()->with('status', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        return back()->with('status', 'Deleted!');
    }
}
