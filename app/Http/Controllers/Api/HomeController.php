<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use Exception;
use App\Models\Brand;
use App\Http\Resources\BrandResource;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use App\Http\Resources\GrowthPathResource;
use App\Http\Resources\ServiceCategoryResource;
use App\Models\Service;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SliderResource;
use App\Models\Activity;
use App\Models\Counter;
use App\Models\GrowthPath;
use App\Models\HappyClient;
use App\Models\Industry;
use App\Models\SectionData;
use App\Models\ServiceCarousel;
use App\Models\ServiceCategory;
use App\Models\ServiceList;
use App\Models\Siteinfo;
use App\Models\Slider;
use App\Models\SolutionCategory;
use App\Models\Metadata;
use App\Models\Offer;
use App\Models\Popup;
use App\Models\ProductSegment;
use App\Models\Team;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function data()
    {
        // Log::info('Home page data requested');
        try {
            // Section Data
            $sectionData = SectionData::where('page', 'home')->get();
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
            $sliders = Slider::where('page_name', 'home')
                ->where('visible', 1)
                ->orderBy('position', 'asc')
                ->get();
            $sliders = $sliders->map(fn($slider) => new SliderResource($slider));

            // About Slider
            $about_sliders = Slider::where('page_name', 'home/about')
                ->where('visible', 1)
                ->orderBy('position', 'asc')
                ->get();
            $about_sliders = $about_sliders->map(fn($slider) => new SliderResource($slider));

            // // Service Carousel
            // $serviceCarousels = ServiceCarousel::where('carousel_for', 'home')
            //     ->where('visible', 1)
            //     ->get();
            // $serviceCarousels = $serviceCarousels->map(function ($service) {
            //     return [
            //         "title" => $service->title,
            //         "url" => $service->url,
            //         "overview" => $service->overview,
            //     ];
            // });

            // // Counters
            // $counters = Counter::where('counter_for', 'home')->get();
            // $counters = $counters->map(function ($counter) {
            //     return [
            //         "label" => $counter->label,
            //         "digit" => $counter->digit,
            //     ];
            // });

            // // Service Lists
            // $serviceList = ServiceList::where('service_for', 'home')
            //     ->where('visible', 1)
            //     ->get();
            // $serviceList = $serviceList->map(function ($service) {
            //     $services = [];
            //     foreach (explode(',', $service->services) as $item) {
            //         $services[] = trim($item);
            //     }

            //     return [
            //         "title" => $service->title,
            //         "identifier" => $service->identifier,
            //         "service_for" => $service->service_for,
            //         "services" => $services,
            //         "overview" => $service->overview,
            //         "caption" => $service->caption,
            //         "image" => env('APP_ENV') == 'local' ? asset('storage/' . $service->image) : secure_asset('storage/' . $service->image),
            //     ];
            // });

            // Welcome
            // Services
            // $services = Service::where('highlighted', true)->where('visible', true)->get()->take(6);
            // $services = $services->map(fn($service) => new ServiceResource($service));

            // Recent activities
            $activities = Activity::where('visible', true)
                ->latest()
                ->get()
                ->take(4);
            $activities = $activities->map(fn($post) => new ActivityResource($post));

            // wings category

            $service_categories = ServiceCategory::where('visible', true)
                ->where('type', 'service')
                ->take(7)
                ->get();
            $service_categories = $service_categories->map(fn($serviceCategories) => new ServiceCategoryResource($serviceCategories));
            // // Brands
            // $brands = Brand::where('visible', true)->get();
            // $brands = $brands->map(fn ($brand) => new BrandResource($brand));

            // Top Industrial Services
            // Mission
            // Special Services
            // Appointment

            $supports = Team::where('support', 1)->get()->take(3);

            // Clients
            $clients = Client::where('visible', true)->get();
            $clients = $clients->map(fn($client) => new ClientResource($client));

            // growth path
            $growth_paths = GrowthPath::where('visible', true)->get();
            $growth_paths = $growth_paths->map(fn($growth_paths) => new GrowthPathResource($growth_paths));

            // // Testimonials
            // $testimonials = HappyClient::where('visible', true)->inRandomOrder()->get()->take(4);
            // $testimonials = $testimonials->map(function ($testimonial) {
            //     return [
            //         "name" => $testimonial->name,
            //         "designation" => $testimonial->designation,
            //         "company" => $testimonial->company,
            //         "comment" => $testimonial->comment,
            //     ];
            // });

            // Metadata
            $meta = Metadata::where('page_name', 'home')->first();

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "meta" => $meta,
                    "sectionData" => $sectionData,
                    "sliders" => $sliders,
                    "about_sliders" => $about_sliders,
                    // "serviceCarousels" => $serviceCarousels,
                    // "counters" => $counters,
                    // "serviceList" => $serviceList,
                    // "brands" => $brands,
                    "clients" => $clients,
                    // "services" => $services,
                    "activities" => $activities,
                    "growth_paths" => $growth_paths,
                    // "testimonials" => $testimonials,
                    "supports" => $supports,
                    "service_categories" => $service_categories,
                ]
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            return response($exception->getMessage(), 500);
        }
    }

    public function siteinfo()
    {
        try {
            // Site Informations
            $informations = Siteinfo::latest()->first();

            // Offer
            $offers = Offer::where('visible', true)
                ->where('starting_date', '<=', now())
                ->where('ending_date', '>=', now())
                ->count();

            // Popup
            $popup = Popup::where('visible', true)
                ->where('starting_date', '<=', now())
                ->where('ending_date', '>=', now())
                ->latest()
                ->first();
            $popup = $popup ? [
                "title" => $popup->title,
                "url" => $popup->url,
                "image" => env('APP_ENV') == 'local' ? asset('storage/' . $popup->image) : secure_asset('storage/' . $popup->image),
            ] : null;

            // Industries
            $industries = Industry::where('visible', true)->get();
            $industries = $industries->map(function ($industry) {
                return [
                    "title" => $industry->title,
                    "url" => $industry->url,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $industry->image_small) : secure_asset('storage/' . $industry->image_small),
                ];
            });

            // Segments
            $segments = ProductSegment::where('visible', true)->get();
            $segments = $segments->map(function ($segment) {
                return [
                    "title" => $segment->title,
                    "url" => $segment->url,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $segment->image_small) : secure_asset('storage/' . $segment->image_small),
                ];
            });

            // Service Categories
            $service_categories = ServiceCategory::with('subcategories', 'services')
                ->where('visible', true)
                ->where('type', 'service')
                ->get();
            $service_categories = $service_categories->map(function ($category) {
                return [
                    "title" => $category->title,
                    "url" => $category->url,
                    "image" => secure_asset('storage/' . $category->image_small),
                    "subcategories" => $category->subcategories->map(function ($subcategory) {
                        return [
                            "title" => $subcategory->title,
                            "url" => $subcategory->url,
                        ];
                    }),
                ];
            });

            // industry Categories
            $industry_categories = ServiceCategory::where('visible', true)
                ->where('type', 'industry')
                ->get();

            $industry_categories = $industry_categories->map(function ($category) {
                $services = Industry::where('category_id', $category->id)->get();

                return [
                    "title" => $category->title,
                    "url" => $category->url,
                    "image" => secure_asset('storage/' . $category->image_small),
                    "services" => $services->map(function ($service) {
                        return [
                            "title" => $service->title,
                            "url" => $service->url,
                        ];
                    }),
                ];
            });

            // segment Categories
            $segment_categories = ServiceCategory::where('visible', true)
                ->where('type', 'segment')
                ->get();

            $segment_categories = $segment_categories->map(function ($category) {
                $services = ProductSegment::where('category_id', $category->id)->get();

                return [
                    "title" => $category->title,
                    "url" => $category->url,
                    "image" => secure_asset('storage/' . $category->image_small),
                    "services" => $services->map(function ($service) {
                        return [
                            "title" => $service->title,
                            "url" => $service->url,
                        ];
                    }),
                ];
            });

            // // Solution Categories
            // $solution_categories = SolutionCategory::where('visible', true)->get();
            // $solution_categories = $solution_categories->map(function ($category) {
            //     return [
            //         "title" => $category->title,
            //         "url" => $category->url,
            //         "image" => secure_asset('storage/' . $category->image_small),
            //     ];
            // });

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "informations" => $informations,
                    "offers" => $offers,
                    "popup" => $popup,
                    "industries" => $industries,
                    "segments" => $segments,
                    "service_categories" => $service_categories,
                    "industry_categories" => $industry_categories,
                    "segment_categories" => $segment_categories,
                    // "solution_categories" => $solution_categories,
                ]
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            return response($exception->getMessage(), 500);
        }
    }
}
