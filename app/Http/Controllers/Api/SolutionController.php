<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\Metadata;
use App\Models\SectionData;
use App\Models\ServiceCarousel;
use App\Models\ServiceCategory;
use App\Models\ServiceList;
use Illuminate\Http\Request;
use Exception;
use App\Models\Slider;
use App\Models\Solution;
use App\Models\SolutionCategory;
use App\Models\SolutionItem;
use App\Models\SolutionTimeline;

class SolutionController extends Controller
{
    public function data(Request $request)
    {
        try {
            // Section Data
            $sectionData = SectionData::where('page', 'solutions')->get();
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

            // Slider
            $sliders = Slider::where('page_name', 'solutions')
                ->where('visible', 1)
                ->orderBy('position', 'asc')
                ->get();
            $sliders = $sliders->map(fn ($slider) => new SliderResource($slider));

            // Service Carousel
            $serviceCarousels = ServiceCarousel::where('carousel_for', 'solution')
                ->where('visible', 1)
                ->get();
            $serviceCarousels = $serviceCarousels->map(function ($slider) {
                return [
                    "title" => $slider->title,
                    "url" => $slider->url,
                    "overview" => $slider->overview,
                ];
            });

            // Black Card
            $solutionItems = SolutionItem::where('visible', true)->inrandomOrder()->get()->take(3);

            // Timeline
            $timeline = SolutionTimeline::where('visible', true)->orderBy('id', 'desc')->first();
            $timeline = [
                "title_1" => $timeline->title_1,
                "overview_1" => $timeline->overview_1,
                "title_2" => $timeline->title_2,
                "overview_2" => $timeline->overview_2,
                "title_3" => $timeline->title_3,
                "overview_3" => $timeline->overview_3,
                "image" => $timeline->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $timeline->image) : secure_asset('storage/' . $timeline->image)) : null,
            ];

            // Service Categories
            $categories = SolutionCategory::where('visible', 1)->get();
            $categories = $categories->map(function ($category) {
                return [
                    "title" => $category->title,
                    "url" => $category->url,
                    "description" => $category->description,
                    "image" => $category->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $category->image) : secure_asset('storage/' . $category->image)) : null,
                ];
            });

            // Service Lists
            $serviceList = ServiceList::where('service_for', 'solution')
                ->where('visible', 1)
                ->orderBy('id', 'desc')
                ->first();
            $services = [];
            foreach (explode(',', $serviceList->services) as $item) {
                $services[] = trim($item);
            }
            $serviceList = [
                "title" => $serviceList->title,
                "identifier" => $serviceList->identifier,
                "service_for" => $serviceList->service_for,
                "services" => $services,
                "overview" => $serviceList->overview,
                "caption" => $serviceList->caption,
                "image" => env('APP_ENV') == 'local' ? asset('storage/' . $serviceList->image) : secure_asset('storage/' . $serviceList->image),
            ];

            // Metadata
            $meta = Metadata::where('page_name', 'solutions')->first();

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "meta" => $meta,
                    "sectionData" => $sectionData,
                    "sliders" => $sliders,
                    "serviceCarousels" => $serviceCarousels,
                    "solutionItems" => $solutionItems,
                    "timeline" => $timeline,
                    "categories" => $categories,
                    "serviceList" => $serviceList,
                ]
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    public function category($url)
    {
        try {
            $category = SolutionCategory::where('url', $url)
                ->where('visible', 1)
                ->first();

            $category = [
                'created_at' => $category->created_at->format('M d, Y'),
                'duration' => readingTime($category->article),
                'title' => $category->title,
                'url' => $category->url,
                'article' => $category->article,
                "meta_title" => $category->meta_title,
                "description" => $category->description ?? $category->meta_description,
                "meta_keywords" => $category->meta_keywords,
                'image' => env('APP_ENV') == 'local' ? asset('storage/' . $category->image) : secure_asset('storage/' . $category->image),
            ];

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "category" => $category,
                    "tags" => $this->tags()
                ]
            ];

            return response($response, 200);
        } catch (Exception $exception) {
            return $exception->getMessage();
            return response("Something went wrong", 500);
        }
    }

    public function tags()
    {
        $solutions = ServiceCategory::select('meta_keywords')
            ->inRandomOrder()
            ->select('meta_keywords')
            ->take(1)
            ->get();
        $tags = [];
        foreach ($solutions as $solution) {
            foreach (explode(",", $solution->meta_keywords) as $tag) {
                if ($tag != "") {
                    $tags[] = $tag;
                }
            }
        }
        return $tags;
    }
}
