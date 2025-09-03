<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::where('visible', 1)
                        ->orderBy('position', 'asc')
                        ->get();
        return view('panel.slider.index', ['sliders' => $sliders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.slider.create');
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
            $path = "sliders";
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
     * @param  \App\Http\Requests\StoreSliderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSliderRequest $request)
    {
        $slider = Slider::create([
            'visible' => $request->visible,
            'page_name' => $request->page_name,
            'slogan' => $request->slogan,
            'slogan_color' => $request->slogan_color,
            'title' => $request->title,
            'title_color' => $request->title_color,
            'overview' => $request->overview,
            'overview_color' => $request->overview_color,
            'link' => $request->link,
            'link_text' => $request->link_text,
            'button_color' => $request->button_color,
            'label_color' => $request->label_color,
            'created_by' => auth()->id(),
            'created_at' => now(),
        ]);

        // Assets checker
        $this->assetsChecker($slider, $request);

        return back()->with('success', 'Stored!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        return view('panel.slider.create', ['slider' => $slider]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('panel.slider.edit', ['slider' => $slider]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $slider->update([
            'visible' => $request->visible,
            'page_name' => $request->page_name,
            'slogan' => $request->slogan,
            'slogan_color' => $request->slogan_color,
            'title' => $request->title,
            'title_color' => $request->title_color,
            'overview' => $request->overview,
            'overview_color' => $request->overview_color,
            'link' => $request->link,
            'link_text' => $request->link_text,
            'button_color' => $request->button_color,
            'label_color' => $request->label_color,
            'updated_by' => auth()->id(),
            'updated_at' => now(),
        ]);

        // Assets checker
        $this->assetsChecker($slider, $request);

        return back()->with('success', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        Storage::delete($slider->image);
        Storage::delete($slider->image_medium);
        Storage::delete($slider->image_small);

        $slider->delete();

        return back()->with('success', 'Deleted!');
    }
}
