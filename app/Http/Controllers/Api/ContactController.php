<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Models\Metadata;
use App\Models\SectionData;
use App\Models\Slider;
use App\Models\Subscriber;
use App\Models\Team;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function data(Request $request)
    {
        try {
            // Metadata
            $meta = Metadata::where('page_name', 'contact')->first();

            // Slider
            $sliders = Slider::where('page_name', 'contact')
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


             $members=Team::where('contact',1)->get()->take(3);

            // Section Data
            $sectionData = SectionData::where('page', 'contact')->latest()->first();
            $sectionData = [
                "title" => $sectionData->title,
                "image" => env('APP_ENV') == 'local' ? asset('storage/' . $sectionData->image) : secure_asset('storage/' . $sectionData->image),
            ];

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "meta" => $meta,
                    "sectionData" => $sectionData,
                    "sliders" => $sliders,
                    "members" => $members,
                ]
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    public function send(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "phone" => "required",
            "message" => "required",
        ]);

        Mail::to('shuvo.iconic@gmail.com')
            ->bcc(['archive.iconic@gmail.com'])
            ->send(new Contact($request));

        $response = [
            "status" => 1,
            "message" => "Thank you for contacting us!"
        ];
        return response($response, 200);
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            "email" => "required|email|unique:subscribers",
        ], [
            "email.unique" => "Congrats, you are already a subscriber!"
        ]);

        Subscriber::create([
            "email" => $request->email
        ]);

        $response = [
            "status" => 1,
            "message" => "Thank you for being a subscriber!"
        ];
        return response($response, 200);
    }
}
