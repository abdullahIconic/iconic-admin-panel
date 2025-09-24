<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\Counter;
use App\Models\HappyClient;
use App\Models\LpsCard;
use App\Models\LpsMaterial;
use App\Models\Metadata;
use App\Models\RentalTab;
use App\Models\SectionData;
use App\Models\Service;
use App\Models\Industry;
use Exception;
use App\Models\Slider;
use App\Models\ServiceCategory;
use App\Models\ServiceSafety;
use App\Models\ServiceSubcategory;
use App\Models\ServiceWwd;
use App\Models\Team;

class ServiceController extends Controller
{
    public function data()
    {
        try {
            // Section Data
            $sectionData = SectionData::where('page', 'services')->get();
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
            $sliders = Slider::where('page_name', 'services')
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

            // What We Delivered
            $serviceWwd = ServiceWwd::where('visible', true)->inrandomOrder()->get()->take(4);
            $serviceWwd = $serviceWwd->map(function ($data) {
                return [
                    "title" => $data->title,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $data->image_medium) : secure_asset('storage/' . $data->image_medium),
                ];
            });

            // Service Categories
            $categories = ServiceCategory::where('visible', 1)->where('type', 'service')->get();
            $categories = $categories->map(function ($category) {
                return [
                    "slogan" => $category->slogan,
                    "title" => $category->title,
                    "url" => $category->url,
                    "description" => $category->description,
                    "image" => $category->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $category->image) : secure_asset('storage/' . $category->image)) : null,
                ];
            });

            // We Focus On Safety
            $safeties = ServiceSafety::where('visible', 1)->get();

            // Metadata
            $meta = Metadata::where('page_name', 'services')->first();

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "meta" => $meta,
                    "sectionData" => $sectionData,
                    "sliders" => $sliders,
                    "serviceWwd" => $serviceWwd,
                    "categories" => $categories,
                    "safeties" => $safeties,
                ]
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            $response = [
                "status" => 0,
                "message" => "failed"
            ];
            return response($response, 500);
        }
    }

    // public function category($category)
    // {
    //     try {

    //         // Section Data
    //         $sectionData = collect(SectionData::where('page', $category)->get());
    //         $subscriptionSectionData = collect(SectionData::where('page', 'common')->get());
    //         $sectionData = $sectionData->merge($subscriptionSectionData);

    //         $sectionData = $sectionData->map(function ($data) {
    //             return [
    //                 "page" => $data->page,
    //                 "section" => $data->section,
    //                 "title" => $data->title,
    //                 "url" => $data->url,
    //                 "label" => $data->label,
    //                 "slogan" => $data->slogan,
    //                 "overview" => $data->overview,
    //                 "image" => env('APP_ENV') == 'local' ? asset('storage/' . $data->image) : secure_asset('storage/' . $data->image),
    //                 "image_alt" => $data->image_alt,
    //             ];
    //         });

    //         if ($category == 'rental') {
    //             // Slider
    //             $sliders = Slider::where('page_name', $category)
    //                 ->where('visible', 1)
    //                 ->orderBy('position', 'asc')
    //                 ->get();

    //             $sliders = $sliders->map(fn ($slider) => new SliderResource($slider));


    //             // Category
    //             $rental = ServiceCategory::where('url', $category)->firstOrFail();

    //             // Services
    //             $services = Service::where('category_id', $rental->id)
    //                 ->where('visible', true)
    //                 ->get();
    //             $services = $services->map(function ($service) {
    //                 return [
    //                     "id" => $service->id,
    //                     "slogan" => $service->slogan,
    //                     "title" => $service->title,
    //                     "url" => $service->url,
    //                     "meta_description" => $service->meta_description,
    //                     "image" => asset('storage/' . $service->image_medium)
    //                 ];
    //             });

    //             // Tabs
    //             $tabs = RentalTab::where('visible', true)->get();

    //             // HappyClients
    //             $testimonials = HappyClient::where('happy_for', $category)->inRandomOrder()->get()->take(3);
    //             $testimonials = $testimonials->map(function ($testimonial) {
    //                 return [
    //                     "name" => $testimonial->name,
    //                     "comment" => $testimonial->comment,
    //                 ];
    //             });

    //             $response = [
    //                 "status" => 1,
    //                 "message" => "success",
    //                 "data" => [
    //                     "sectionData" => $sectionData,
    //                     "sliders" => $sliders,
    //                     "category" => $rental,
    //                     "services" => $services ?? [],
    //                     "tabs" => $tabs,
    //                     "testimonials" => $testimonials,
    //                 ]
    //             ];

    //             return response($response, 200);
    //         } else {

    //             // Slider
    //             $sliders = Slider::where('page_name', $category)
    //                 ->where('visible', 1)
    //                 ->orderBy('position', 'asc')
    //                 ->get();
    //             $sliders = $sliders->map(fn ($slider) => new SliderResource($slider));

    //             // Counters
    //             $counters = Counter::where('counter_for', $category)->get();
    //             $counters = $counters->map(function ($counter) {
    //                 return [
    //                     "label" => $counter->label,
    //                     "digit" => $counter->digit,
    //                 ];
    //             });

    //             // Category
    //             $category = ServiceCategory::where('url', $category)->firstOrFail();

    //             // Best Features Images
    //             $bestFeaturesImages = $category?->feature_images()->where('visible', true)->get();
    //             $bestFeaturesImages = $bestFeaturesImages->map(function ($image) {
    //                 return [
    //                     "title" => $image->title,
    //                     "image" => env('APP_ENV') == 'local' ? asset('storage/' . $image->image) : secure_asset('storage/' . $image->image),
    //                 ];
    //             });

    //             // Services
    //             $services = $category->services()->where('visible', 1)->get();
    //             $services = $services->map(function ($service) {
    //                 return [
    //                     'title' => $service->title,
    //                     'url' => $service->url,
    //                     'description' => $service->description,
    //                     'image' => env('APP_ENV') == 'local' ? asset('storage/' . $service->image_medium) : secure_asset('storage/' . $service->image_medium),
    //                 ];
    //             });

    //             // Experts
    //             $experts = Team::where('expert', 1)->where(function ($query) use ($category) {
    //                 if ($category->url == 'calibration' || $category->url == 'lightning-protection-system') {
    //                     return $query->where('expert_in', $category->url);
    //                 } else {
    //                     return $query->where('expert_in', 'service');
    //                 }
    //             })->where('visible', 1)->get();

    //             $experts = $experts->map(function ($expert) {
    //                 return [
    //                     'name' => $expert->name,
    //                     'email' => $expert->email,
    //                     'phone' => $expert->phone,
    //                     'image' => env('APP_ENV') == 'local' ? asset('storage/' . $expert->image_medium) : secure_asset('storage/' . $expert->image_medium),
    //                 ];
    //             });

    //             // HappyClients
    //             $testimonials = HappyClient::where('happy_for', $category->url)->get();
    //             $testimonials = $testimonials->map(function ($testimonial) {
    //                 return [
    //                     "name" => $testimonial->name,
    //                     "designation" => $testimonial->designation,
    //                     "company" => $testimonial->company,
    //                     "comment" => $testimonial->comment,
    //                 ];
    //             });

    //             $response = [
    //                 "status" => 1,
    //                 "message" => "success",
    //                 "data" => [
    //                     "sectionData" => $sectionData,
    //                     "bestFeaturesImages" => $bestFeaturesImages ?? [],
    //                     "sliders" => $sliders,
    //                     "counters" => $counters,
    //                     "category" => $category,
    //                     "services" => $services ?? [],
    //                     "experts" => $experts ?? [],
    //                     "testimonials" => $testimonials ?? [],
    //                 ]
    //             ];
    //             return response($response, 200);
    //         }
    //     } catch (Exception $exception) {
    //         $response = [
    //             "status" => 0,
    //             "message" => "failed"
    //         ];
    //         return response($response, 500);
    //     }
    // }

    public function category($category)
    {
        try {
            // Section Data
            $sectionData = collect(SectionData::where('page', $category)->get());
            $subscriptionSectionData = collect(SectionData::where('page', 'common')->get());
            $sectionData = $sectionData->merge($subscriptionSectionData);

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

            // Category fetch
            $categoryModel = ServiceCategory::where('url', $category)->firstOrFail();

            // ✅ Subcategories fetch
            $subcategories = ServiceSubcategory::where('category_id', $categoryModel->id)
                ->where('visible', 1)
                ->orderBy('position', 'asc')
                ->get();

            // ✅ Services nested under each subcategory
            $subcategories = $subcategories->map(function ($subcat) {
                $services = Service::where('sub_category_id', $subcat->id)
                    ->where('visible', true)
                    ->get();

                $services = $services->map(function ($service) {
                    return [
                        "id" => $service->id,
                        "slogan" => $service->slogan,
                        "title" => $service->title,
                        "url" => $service->url,
                        "meta_description" => $service->meta_description,
                        "image" => env('APP_ENV') == 'local' ? asset('storage/' . $service->image) : secure_asset('storage/' . $service->image)
                    ];
                });

                return [
                    "id" => $subcat->id,
                    "title" => $subcat->title,
                    "url" => $subcat->url,
                    "description" => $subcat->description,
                    "article" => $subcat->article,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $subcat->image) : secure_asset('storage/' . $subcat->image),
                    "services" => $services
                ];
            });

            // Sliders, Counters, Experts, Testimonials same as before
            $sliders = Slider::where('page_name', $category)
                ->where('visible', 1)
                ->orderBy('position', 'asc')
                ->get();
            $sliders = $sliders->map(fn($slider) => new SliderResource($slider));

            $counters = Counter::where('counter_for', $category)->get()->map(function ($counter) {
                return [
                    "label" => $counter->label,
                    "digit" => $counter->digit,
                ];
            });

            $bestFeaturesImages = $categoryModel?->feature_images()->where('visible', true)->get()->map(function ($image) {
                return [
                    "title" => $image->title,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $image->image) : secure_asset('storage/' . $image->image),
                ];
            });

            $experts = Team::where('expert', 1)
                ->where(function ($query) use ($categoryModel) {
                    if ($categoryModel->url == 'calibration' || $categoryModel->url == 'lightning-protection-system') {
                        return $query->where('expert_in', $categoryModel->url);
                    } else {
                        return $query->where('expert_in', 'service');
                    }
                })
                ->where('visible', 1)
                ->get()
                ->map(function ($expert) {
                    return [
                        'name' => $expert->name,
                        'email' => $expert->email,
                        'phone' => $expert->phone,
                        'image' => env('APP_ENV') == 'local' ? asset('storage/' . $expert->image_medium) : secure_asset('storage/' . $expert->image_medium),
                    ];
                });

            $testimonials = HappyClient::where('happy_for', $categoryModel->url)->get()->map(function ($testimonial) {
                return [
                    "name" => $testimonial->name,
                    "designation" => $testimonial->designation,
                    "company" => $testimonial->company,
                    "comment" => $testimonial->comment,
                ];
            });

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "sectionData" => $sectionData,
                    "bestFeaturesImages" => $bestFeaturesImages ?? [],
                    "sliders" => $sliders,
                    "counters" => $counters,
                    "category" => $categoryModel,
                    "subcategories" => $subcategories,
                    "experts" => $experts ?? [],
                    "testimonials" => $testimonials ?? [],
                ]
            ];

            return response($response, 200);
        } catch (\Exception $exception) {
            return response([
                "status" => 0,
                "message" => "failed",
                "error" => $exception->getMessage()
            ], 500);
        }
    }


    public function subcategory($subcategoryUrl)
    {
        try {
            // 🔹 Section Data
            $sectionData = SectionData::whereIn('page', [$subcategoryUrl, 'common'])->get()->map(function ($data) {
                return [
                    "page" => $data->page,
                    "section" => $data->section,
                    "title" => $data->title,
                    "url" => $data->url,
                    "label" => $data->label,
                    "slogan" => $data->slogan,
                    "overview" => $data->overview,
                    "image" => $data->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $data->image) : secure_asset('storage/' . $data->image)) : null,
                    "image_alt" => $data->image_alt,
                ];
            });

            // 🔹 Sliders
            $sliders = Slider::where('page_name', $subcategoryUrl)
                ->where('visible', 1)
                ->orderBy('position', 'asc')
                ->get()
                ->map(fn($slider) => [
                    "slogan" => $slider->slogan,
                    "title" => $slider->title,
                    "overview" => $slider->overview,
                    "link" => $slider->link,
                    "link_text" => $slider->link_text,
                    "image" => $slider->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $slider->image) : secure_asset('storage/' . $slider->image)) : null,
                ]);

            // 🔹 Counters
            $counters = Counter::where('counter_for', $subcategoryUrl)->get()->map(function ($counter) {
                return [
                    "label" => $counter->label,
                    "digit" => $counter->digit,
                ];
            });

            // 🔹 Subcategory fetch
            $subcategory = ServiceSubcategory::where('url', $subcategoryUrl)->first();
            if (!$subcategory) {
                return response()->json([
                    "status" => 0,
                    "message" => "failed",
                    "error" => "Subcategory not found"
                ], 404);
            }



            // 🔹 Services under this subcategory
            $services = $subcategory->services()->get()->map(function ($service) {
                return [
                    "id" => $service->id,
                    "title" => $service->title,
                    "article" => $service->article,
                    "subcategory" => $service->subcategory,
                    "url" => $service->url,
                    "image" => $service->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $service->image) : secure_asset('storage/' . $service->image)) : null,
                ];
            });

            // 🔹 Response
            return response()->json([
                "status" => 1,
                "message" => "success",
                "data" => [
                    "sectionData" => $sectionData,
                    "sliders" => $sliders,
                    "counters" => $counters,
                    "subcategory" => $subcategory,
                    "services" => $services,
                ]
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                "status" => 0,
                "message" => "failed",
                "error" => $exception->getMessage()
            ], 500);
        }
    }


    public function icategory($category)
    {
        try {

            // Section Data
            $sectionData = collect(SectionData::where('page', $category)->get());
            $subscriptionSectionData = collect(SectionData::where('page', 'common')->get());
            $sectionData = $sectionData->merge($subscriptionSectionData);

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
            $sliders = Slider::where('page_name', $category)
                ->where('visible', 1)
                ->orderBy('position', 'asc')
                ->get();
            $sliders = $sliders->map(fn($slider) => new SliderResource($slider));

            // Counters
            $counters = Counter::where('counter_for', $category)->get();
            $counters = $counters->map(function ($counter) {
                return [
                    "label" => $counter->label,
                    "digit" => $counter->digit,
                ];
            });

            // Category
            $category = ServiceCategory::where('url', $category)->firstOrFail();

            // Best Features Images
            $bestFeaturesImages = $category?->feature_images()->where('visible', true)->get();
            $bestFeaturesImages = $bestFeaturesImages->map(function ($image) {
                return [
                    "title" => $image->title,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $image->image) : secure_asset('storage/' . $image->image),
                ];
            });

            // Services
            // $services = $category->services()->where('visible', 1)->get();
            // $services = $services->map(function ($service) {
            //     return [
            //         'title' => $service->title,
            //         'url' => $service->url,
            //         'description' => $service->description,
            //         'image' => env('APP_ENV') == 'local' ? asset('storage/' . $service->image_medium) : secure_asset('storage/' . $service->image_medium),
            //     ];
            // });

            // industries
            $industries = Industry::where('visible', 1)->where('category_id', $category->id)->get();
            $industries = $industries->map(function ($industry) {
                return [
                    "title" => $industry->title,
                    "url" => $industry->url,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $industry->image) : secure_asset('storage/' . $industry->image),
                    "description" => $industry->description,
                ];
            });



            // Experts
            $experts = Team::where('expert', 1)->where(function ($query) use ($category) {
                if ($category->url == 'calibration' || $category->url == 'lightning-protection-system') {
                    return $query->where('expert_in', $category->url);
                } else {
                    return $query->where('expert_in', 'service');
                }
            })->where('visible', 1)->get();

            $experts = $experts->map(function ($expert) {
                return [
                    'name' => $expert->name,
                    'email' => $expert->email,
                    'phone' => $expert->phone,
                    'image' => env('APP_ENV') == 'local' ? asset('storage/' . $expert->image_medium) : secure_asset('storage/' . $expert->image_medium),
                ];
            });

            // HappyClients
            $testimonials = HappyClient::where('happy_for', $category->url)->get();
            $testimonials = $testimonials->map(function ($testimonial) {
                return [
                    "name" => $testimonial->name,
                    "designation" => $testimonial->designation,
                    "company" => $testimonial->company,
                    "comment" => $testimonial->comment,
                ];
            });

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "sectionData" => $sectionData,
                    "bestFeaturesImages" => $bestFeaturesImages ?? [],
                    "sliders" => $sliders,
                    "counters" => $counters,
                    "category" => $category,
                    "services" => $industries ?? [],
                    "experts" => $experts ?? [],
                    "testimonials" => $testimonials ?? [],
                ]
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            $response = [
                "status" => 0,
                "message" => "failed"
            ];
            return response($response, 500);
        }
    }

    public function service($url)
    {
        try {
            if ($url == 'digital' || $url == 'conventional') {
                // Section Data
                $sectionData = SectionData::where('page', $url . "Lps")->get();
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

                // Service
                $service = Service::where('url', $url)
                    ->where('visible', 1)
                    ->first();

                // Slider
                $sliders = Slider::where('page_name', $url)
                    ->where('visible', 1)
                    ->orderBy('position', 'asc')
                    ->get();
                $sliders = $sliders->map(fn($slider) => new SliderResource($slider));

                // Cards
                $cards = LpsCard::where('page_name', $url)->where('visible', true)->get();
                $cards = $cards->map(function ($card) {
                    return [
                        "page_name" => $card->page_name,
                        "card_for" => $card->card_for,
                        "card_type" => $card->card_type,
                        "title" => $card->title,
                        "overview" => $card->overview,
                        "url" => $card->url,
                        "image" => env('APP_ENV') == 'local' ? asset('storage/' . $card->image_medium) : secure_asset('storage/' . $card->image_medium),
                    ];
                });

                // Materials
                $materials = LpsMaterial::where('material_for', $url)->where('visible', true)->get();
                $materials = $materials->map(function ($material) {
                    return [
                        "title" => $material->title,
                        "material_for" => $material->material_for,
                        "image" => env('APP_ENV') == 'local' ? asset('storage/' . $material->image) : secure_asset('storage/' . $material->image),
                    ];
                });

                $response = [
                    "status" => 1,
                    "message" => "success",
                    "data" => [
                        "sectionData" => $sectionData,
                        "service" => $service,
                        "sliders" => $sliders,
                        "cards" => $cards,
                        "materials" => $materials,
                    ]
                ];

                return response($response, 200);
            } else {

                // Service
                $service = Service::where('url', $url)
                    ->where('visible', 1)
                    ->first();

                if (!$service) {
                    return response()->json([
                        "status" => 0,
                        "message" => "Service not found",
                    ], 404);
                }

                // Service Categories
                $categories = ServiceCategory::where('visible', 1)->get();

                // Related Services
                $relatedServices = $service->category
                    ? $service->category->services()->where('visible', true)->get()
                    : collect([]);

                $relatedServices = $relatedServices->map(function ($related) {
                    return [
                        'created_at' => $related->created_at->format('M d, Y'),
                        'duration' => readingTime($related->article),
                        "title" => $related->title,
                        "url" => $related->url,
                        "category_url" => $related->category->url,
                    ];
                });

                $serviceData = [
                    'category' => $service->category,
                    'created_at' => $service->created_at->format('M d, Y'),
                    'duration' => readingTime($service->article),
                    'title' => $service->title,
                    'url' => $service->url,
                    'article' => $service->article,
                    "meta_title" => $service->meta_title,
                    "meta_description" => $service->meta_description,
                    "meta_keywords" => $service->meta_keywords,
                    'image' => env('APP_ENV') == 'local'
                        ? asset('storage/' . $service->image)
                        : secure_asset('storage/' . $service->image),
                ];

                return response()->json([
                    "status" => 1,
                    "message" => "success",
                    "data" => [
                        "service" => $serviceData,
                        "relatedServices" => $relatedServices,
                        "categories" => $categories,
                        "tags" => $this->tags()
                    ]
                ], 200);
            }
        } catch (Exception $exception) {
            $response = [
                "status" => 0,
                "message" => "failed"
            ];
            return response($response, 500);
        }
    }
    public function iservice($url)
    {
        try {
            // Service
            $service = Industry::where('url', $url)
                ->where('visible', 1)
                ->first();

            // Service Categories
            $categories = ServiceCategory::where('visible', 1)->get();

            //   $industries = Industry::where('visible', 1)->where('category_id', $category->id)->get();
            $relatedServices =  Industry::where('visible', 1)->where('category_id', $service->category_id)->get();
            $relatedServices = $relatedServices->map(function ($service) {
                return [
                    'created_at' => $service->created_at->format('M d, Y'),
                    'duration' => readingTime($service->article),
                    "title" => $service->title,
                    "url" => $service->url,
                    "category_url" => $service->category->url,
                ];
            });

            $service = [
                'category' => $service->category,
                'created_at' => $service->created_at->format('M d, Y'),
                'duration' => readingTime($service->article),
                'title' => $service->title,
                'url' => $service->url,
                'article' => $service->article,
                "meta_title" => $service->meta_title,
                "meta_description" => $service->meta_description,
                "meta_keywords" => $service->meta_keywords,
                'image' => env('APP_ENV') == 'local' ? asset('storage/' . $service->image) : secure_asset('storage/' . $service->image),
            ];

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "service" => $service,
                    "relatedServices" => $relatedServices ?? [],
                    "categories" => $categories,
                    "tags" => $this->tags()
                ]
            ];

            return response($response, 200);
        } catch (Exception $exception) {
            $response = [
                "status" => 0,
                "message" => "failed"
            ];
            return response($response, 500);
        }
    }

    public function tags()
    {
        $services = Service::select('meta_keywords')
            ->inRandomOrder()
            ->select('meta_keywords')
            ->take(1)
            ->get();
        $tags = [];
        foreach ($services as $service) {
            foreach (explode(",", $service->meta_keywords) as $tag) {
                if ($tag != "") {
                    $tags[] = $tag;
                }
            }
        }
        return $tags;
    }
}
