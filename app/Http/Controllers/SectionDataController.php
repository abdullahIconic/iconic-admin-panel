<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Http\Requests\StoreSectionDataRequest;
use App\Http\Requests\UpdateSectionDataRequest;
use App\Models\SectionData;
use Illuminate\Support\Facades\Storage;

class SectionDataController extends Controller
{
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
            $path = "section-data";
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
     * @param  \App\Http\Requests\StoreSectionDataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSectionDataRequest $request)
    {
        $request->validate([
            'page' => 'required',
            'section' => 'required',
            'overview' => 'required',
        ]);
    
        $section = SectionData::create([
            "page" => $request->page,
            "section" => $request->section,
            "title" => $request->title,
            "url" => $request->url,
            "label" => $request->label,
            "slogan" => $request->slogan,
            "overview" => $request->overview,
            "image_alt" => $request->image_alt,
            'created_by' => auth()->id(),
            'created_at' => now(),
        ]);

        $this->assetsChecker($section, $request);

        return redirect(route('section-data.index'))->with('status', 'Stored!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSectionDataRequest  $request
     * @param  \App\Models\SectionData  $sectionData
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectionDataRequest $request, SectionData $section_datum)
    {
        $request->validate([
            'page' => 'required',
            'section' => 'required',
            'overview' => 'required',
        ]);
    
        $section_datum->update([
            "page" => $request->page,
            "section" => $request->section,
            "title" => $request->title,
            "url" => $request->url,
            "label" => $request->label,
            "slogan" => $request->slogan,
            "overview" => $request->overview,
            "image_alt" => $request->image_alt,
            'updated_by' => auth()->id(),
            'updated_at' => now(),
        ]);

        $this->assetsChecker($section_datum, $request);

        return redirect(route('section-data.index'))->with('status', 'Updated!');
    }
}
