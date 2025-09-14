<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Models\ServiceCategory;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreServiceCategoryRequest;
use App\Http\Requests\UpdateServiceCategoryRequest;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ServiceCategory::all();
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
            $path = "services/categories";
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

        // Checking for icon
        if ($request->hasFile('icon')) {
            Storage::disk('public')->delete($entry->icon);

            $path = "services/categories/icons";
            $filename = uniqid() . '.' . $request->file('icon')->getClientOriginalExtension();

            $image = Image::make($request->file('icon'))
                ->fit(100, 100)
                ->encode();

            Storage::disk('public')->put($path . '/' . $filename, (string) $image);

            $entry->update([
                "icon"       => $path . '/' . $filename,
                "updated_by" => auth()->id(),
                "updated_at" => now(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServiceCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceCategoryRequest $request)
    {
        $serviceCategory = ServiceCategory::create([
            "visible" => $request->visible,
            "slogan" => $request->title,
            "title" => $request->title,
            "url" => $request->url,
            "overview" => $request->overview,
            "solution_overview" => $request->solution_overview,
            "project_overview" => $request->project_overview,
            "description" => $request->description,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($serviceCategory, $request);

        return back()->with('success', 'Stored!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceCategory $serviceCategory)
    {
        return view('panel.blog.category.edit', ['category' => $serviceCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceCategory $serviceCategory)
    {
        return view('panel.blog.category.edit', ['blogCategory' => $serviceCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceCategoryRequest  $request
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceCategoryRequest $request, ServiceCategory $category)
    {
        $category->update([
            "visible" => $request->visible,
            "slogan" => $request->slogan,
            "title" => $request->title,
            "url" => $request->url,
             "overview" => $request->overview,
            "solution_overview" => $request->solution_overview,
            "project_overview" => $request->project_overview,
            "description" => $request->description,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($category, $request);

        return redirect(route('services.categories.index'))->with('status', 'Updated!');
    }
}
