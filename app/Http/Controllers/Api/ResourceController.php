<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\ResourceItem;
use App\Models\Metadata;
use App\Models\ServiceList;
use Illuminate\Http\Request;
use Exception;
use App\Models\Slider;

class ResourceController extends Controller
{
    public function data(Request $request)
    {
        try{
            // Slider
            $sliders = Slider::where('page_name', 'resource')
                            ->where('visible', 1)
                            ->orderBy('position', 'asc')
                            ->get();
            $sliders = $sliders->map(fn($slider) => new SliderResource($slider));

            // Resource Items
            $resourceItems = ResourceItem::where('visible', 1)->get();
            $resourceItems = $resourceItems->map(function($item){
                return [
                    "title" => $item->title,
                    "url" => $item->url,
                    "description" => $item->description,
                    "image" => $item->image ? (env('APP_ENV') == 'local' ? asset('storage/'.$item->image) : secure_asset('storage/'.$item->image)) : null,
                ];
            });

            // Metadata
            $meta = Metadata::where('page_name', 'resource')->first();

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "meta" => $meta,
                    "sliders" => $sliders,
                    "aboutItems" => $resourceItems
                ]
            ];
            return response($response, 200);
        }
        catch(Exception $exception){
            return response($exception->getMessage(), 401);
        }
    }
}
