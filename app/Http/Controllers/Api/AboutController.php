<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\AboutItem;
use App\Models\Metadata;
use App\Models\ServiceList;
use Illuminate\Http\Request;
use Exception;
use App\Models\Slider;

class AboutController extends Controller
{
    public function data(Request $request)
    {
        try{
            // Slider
            $sliders = Slider::where('page_name', 'about')
                            ->where('visible', 1)
                            ->orderBy('position', 'asc')
                            ->get();
            $sliders = $sliders->map(fn($slider) => new SliderResource($slider));

            // About Items
            $aboutItems = AboutItem::where('visible', 1)->get();
            $aboutItems = $aboutItems->map(function($item){
                return [
                    "title" => $item->title,
                    "url" => $item->url,
                    "description" => $item->description,
                    "image" => $item->image ? (env('APP_ENV') == 'local' ? asset('storage/'.$item->image) : secure_asset('storage/'.$item->image)) : null,
                ];
            });

            // Service Lists
            $serviceList = ServiceList::where('service_for', 'about')
                                        ->where('visible', 1)
                                        ->orderBy('id', 'desc')
                                        ->first();
            $services = [];
            foreach(explode(',', $serviceList->services) as $item){
                $services[] = trim($item);
            }
            $serviceList = [
                "title" => $serviceList->title,
                "identifier" => $serviceList->identifier,
                "service_for" => $serviceList->service_for,
                "services" => $services,
                "overview" => $serviceList->overview,
                "caption" => $serviceList->caption,
                "image" => env('APP_ENV') == 'local' ? asset('storage/'.$serviceList->image) : secure_asset('storage/'.$serviceList->image),
            ];

            // Metadata
            $meta = Metadata::where('page_name', 'about')->first();

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "meta" => $meta,
                    "sliders" => $sliders,
                    "aboutItems" => $aboutItems,
                    "serviceList" => $serviceList,
                ]
            ];
            return response($response, 200);
        }
        catch(Exception $exception){
            return response($exception->getMessage(), 401);
        }
    }
}
