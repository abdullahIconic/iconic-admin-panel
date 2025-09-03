<?php

namespace App\Http\Controllers;

use App\Helper\Thumbnail;
use App\Http\Requests\StoreServiceListRequest;
use App\Http\Requests\UpdateServiceListRequest;
use App\Models\ServiceList;
use Illuminate\Support\Facades\Storage;

class ServiceListController extends Controller
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
            $path = "services/list";
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
     * @param  \App\Http\Requests\StoreServiceListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceListRequest $request)
    {
        $service = ServiceList::create([
            "visible" => $request->visible,
            "title" => $request->title,
            "identifier" => $request->identifier,
            "service_for" => $request->service_for,
            "services" => $request->services,
            "overview" => $request->overview,
            "caption" => $request->caption,
            "created_by" => auth()->id(),
            "created_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($service, $request);

        return back()->with('success', 'Stored!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceListRequest  $request
     * @param  \App\Models\ServiceList  $serviceList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceListRequest $request, ServiceList $service_list)
    {
        $service_list->update([
            "visible" => $request->visible,
            "title" => $request->title,
            "identifier" => $request->identifier,
            "service_for" => $request->service_for,
            "services" => $request->services,
            "overview" => $request->overview,
            "caption" => $request->caption,
            "updated_by" => auth()->id(),
            "updated_at" => now()
        ]);

        // Assets checker
        $this->assetsChecker($service_list, $request);
   
        return redirect(route('service-list.index'));
    }
}
