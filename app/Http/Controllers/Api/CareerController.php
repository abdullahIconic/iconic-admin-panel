<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\Metadata;
use App\Models\SectionData;
use App\Models\Slider;
use Exception;
use Illuminate\Support\Facades\Log;

class CareerController extends Controller
{
    public function data()
    {
        try{
            // Section Data
            $sectionData = SectionData::where('page', 'careers')->get();
            $sectionData = $sectionData->map(function($data){
                return [
                    "page" => $data->page,
                    "section" => $data->section,
                    "title" => $data->title,
                    "url" => $data->url,
                    "label" => $data->label,
                    "slogan" => $data->slogan,
                    "overview" => $data->overview,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/'.$data->image) : secure_asset('storage/'.$data->image),
                    "image_alt" => $data->image_alt,
                ];
            });

            // Slider
            $sliders = Slider::where('page_name', 'careers')
                ->where('visible', 1)
                ->orderBy('position', 'asc')
                ->get();
            $sliders = $sliders->map(function ($slider) {
                return [
                    "slogan" => $slider->slogan,
                    "slogan_color" => $slider->slogan_color,
                    "title" => $slider->title,
                    "title_color" => $slider->title_color,
                    "overview" => $slider->overview,
                    "overview_color" => $slider->overview_color,
                    "link" => $slider->link,
                    "link_text" => $slider->link_text,
                    "image" => $slider->image,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $slider->image) : secure_asset('storage/' . $slider->image),
                ];
            });

            // Metadata
            $meta = Metadata::where('page_name', 'careers')->first();

            // Service Categories
            $careers = Career::where('visible', 1)->get();
            $careers = $careers->map(function ($career) {
                return [
                    "title" => $career->title,
                    "url" => $career->url,
                    "description" => $career->description,
                    "image" => $career->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $career->image) : secure_asset('storage/' . $career->image)) : null,
                    "button_text"=>$career->button_text,
                    "button_url"=>$career->button_url,
                ];
            });

           // Response
            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "meta" => $meta,
                    "sectionData" => $sectionData,
                    "sliders" => $sliders,
                    "careers" => $careers
                ]
            ];
            return response($response, 200);
        }
        catch(Exception $exception){
            Log::info($exception->getMessage());
            return response($exception->getMessage(), 500);
        }
    }
}
