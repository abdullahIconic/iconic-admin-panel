<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreServiceSubcategoryRequest;
use App\Http\Requests\UpdateServiceSubcategoryRequest;

class ServiceSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = ServiceSubcategory::all();
        return view('livewire.services.subcategories.index', ['subcategories' => $subcategories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ServiceCategory::where('visible', 1)->get();
        return view('livewire.services.subcategories.create', ['categories' => $categories]);
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
            $path = "services/subcategories";
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
     * @param  \App\Http\Requests\StoreServiceSubcategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceSubcategoryRequest $request)
    {

        $request->validate([
            'visible' => 'required',
            'category' => 'required',
            'title' => 'required',
            'url' => 'required|unique:service_subcategories',
            'article' => 'required',
            'image' => 'required|image',
        ]);

        // dd($request->all());
        $subcategory = ServiceSubcategory::create([
            'visible' => $request->visible,
            'position' => $request->position,
            'category_id' => $request->category,
            'slogan' => $request->slogan,
            'title' => $request->title,
            'url' => $request->url,
            'article' => $request->article,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($subcategory, $request);

        return back()->with('success', 'Stored!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceSubcategory $serviceSubcategory)
    {
        return view('livewire.services.subcategories.show', ['serviceSubcategory' => $serviceSubcategory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceSubcategory $subcategory)
    {
        $categories = ServiceCategory::where('visible', 1)->get();
        return view('panel.services.subcategories.edit', ['serviceSubcategory' => $subcategory, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceSubcategoryRequest  $request
     * @param  \App\Models\ServiceSubcategory  $serviceSubcategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceSubcategoryRequest $request, ServiceSubcategory $subcategory)
    {
        $request->validate([
            'visible' => 'required',
            'category' => 'required',
            'title' => 'required',
            'url' => 'required',
            'article' => 'required',
            'image' => 'nullable|image',
        ]);

        // Checking Url Existance
        if ($subcategory->url != $request->url) {
            $request->validate([
                'url' => 'unique:service_subcategories',
            ]);
        }

        $subcategory->update([
            'visible' => $request->visible,
            'position' => $request->position,
            'category_id' => $request->category,
            'slogan' => $request->slogan,
            'title' => $request->title,
            'url' => $request->url,
            'article' => $request->article,
            "meta_title" => $request->meta_title,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($subcategory, $request);
        // dd($subcategories, $request);

        return redirect(route('services.subcategories.index'))->with('status', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceSubcategory  $serviceSubcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceSubcategory $subcategory)
    {
        Storage::delete($subcategory->image);
        Storage::delete($subcategory->image_medium);
        Storage::delete($subcategory->image_small);

        $subcategory->delete();

        return back()->with('status', 'Deleted!');
    }
}
