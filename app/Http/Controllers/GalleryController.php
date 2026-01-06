<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Helper\Thumbnail;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;

class GalleryController extends Controller
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

    //   public function assetsChecker($entry, $request)
    // {
    //     // Checking for sample
    //     if ($request->hasFile('image')) {
    //         Storage::delete($entry->image);
    //         Storage::delete($entry->image_medium);
    //         Storage::delete($entry->image_small);

    //         // Thumbnail Maker
    //         $dimension = [
    //             'medium' => [
    //                 'width' => 320,
    //                 'height' => 180,
    //             ],
    //             'small' => [
    //                 'width' => 240,
    //                 'height' => 135,
    //             ]
    //         ];
    //         $path = "gallerys ";
    //         $thumbnail = Thumbnail::make($request->image, $dimension, $path);
    //         $entry->update([
    //             "image" => $thumbnail['image'],
    //             "image_medium" => $thumbnail['image_medium'],
    //             "image_small" => $thumbnail['image_small'],
    //             "updated_by" => auth()->id(),
    //             "updated_at" => now(),
    //         ]);
    //     }
    // }

    public function assetsChecker($entry, $request)
    {
        // -------------------------
        // IMAGE HANDLING (MAIN IMAGE)
        // -------------------------
        if ($request->hasFile('image')) {

            // Delete existing images
            Storage::delete($entry->image);
            Storage::delete($entry->image_medium);
            Storage::delete($entry->image_small);

            $path = "gallery";

            /* ========= ORIGINAL ========= */
            $original = Image::make($request->file('image'))
                ->resize(800, 650)
                ->encode('jpg', 75);

            $originalName = $path . '/' . uniqid() . '.jpg';
            Storage::put($originalName, (string) $original);

            /* ========= MEDIUM (GRID) ========= */
            $medium = Image::make($request->file('image'))
                ->resize(400, 650, function ($c) {
                    $c->aspectRatio();
                    $c->upsize();
                })
                ->encode('jpg', 75);

            $mediumName = $path . '/medium_' . uniqid() . '.jpg';
            Storage::put($mediumName, (string) $medium);

            /* ========= SMALL (MOBILE) ========= */
            $small = Image::make($request->file('image'))
                ->resize(300, 320, function ($c) {
                    $c->aspectRatio();
                    $c->upsize();
                })
                ->encode('jpg', 75);

            $smallName = $path . '/small_' . uniqid() . '.jpg';
            Storage::put($smallName, (string) $small);

            // Update DB paths
            $entry->update([
                "image" => $originalName,
                "image_medium" => $mediumName,
                "image_small" => $smallName,
                "updated_by" => auth()->id(),
                "updated_at" => now(),
            ]);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGalleryRequest $request)
    {
        $gallery = Gallery::create([
            "visible" => $request->visible,
            "title" => $request->title,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($gallery, $request);

        return redirect()->back()->with('success', 'Stored!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $gallery->update([
            "visible" => $request->visible,
            "title" => $request->title,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($gallery, $request);

        return redirect(route('gallery.index'))->with('status', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
