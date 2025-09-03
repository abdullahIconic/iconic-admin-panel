<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Metadata;
use App\Models\SectionData;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Team;
use Exception;

class TeamController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function data(Request $request)
    {
        try {
            // Slider
            $sliders = Slider::where('page_name', 'team')
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

            // Section Data
            $sectionData = SectionData::where('page', 'team')->get();
            $sectionData = $sectionData->map(function ($data) {
                return [
                    "page" => $data->page,
                    "section" => $data->section,
                    "title" => $data->title,
                    "url" => $data->url,
                    "label" => $data->label,
                    "slogan" => $data->slogan,
                    "overview" => $data->overview,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $data->image) : secure_asset('storage/' . $data->image),
                    "image_alt" => $data->image_alt,
                ];
            });

            // Members
            $members = Team::where('visible', true)->get();
            $members = $members->map(function ($member) {
                return [
                    "name" => $member->name,
                    "designation" => $member->designation,
                    "email" => $member->email,
                    "overview" => $member->overview,
                    "facebook" => $member->facebook,
                    "twitter" => $member->twitter,
                    "linkedin" => $member->linkedin,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $member->image) : secure_asset('storage/' . $member->image),
                ];
            });

            // Metadata
            $meta = Metadata::where('page_name', 'team')->first();

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "meta" => $meta,
                    "sliders" => $sliders,
                    "sectionData" => $sectionData,
                    "members" => $members,
                ]
            ];

            return response($response, 200);
        } catch (Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }
}
