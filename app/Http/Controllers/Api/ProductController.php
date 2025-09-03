<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\SliderResource;
use App\Models\BlogCategory;
use App\Models\Brand;
use App\Models\Faq;
use App\Models\Metadata;
use App\Models\Product;
use App\Models\Review;
use App\Models\ProductCategory;
use App\Models\ServiceCategory;
use App\Models\ProductPromotion;
use App\Models\ProductSegment;
use App\Models\SectionData;
use App\Models\SegmentProject;
use App\Models\SegmentSolution;
use App\Models\Slider;
use App\Models\Team;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        try {
            // Slider
            $sliders = Slider::where('page_name', 'products')
                ->where('visible', 1)
                ->orderBy('position', 'asc')
                ->get();
            $sliders = $sliders->map(fn ($slider) => new SliderResource($slider));

            // Section Data
            $sectionData = SectionData::where('page', 'products')->get();
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

            // product Categories broken
            $product_categories = ProductSegment::where('visible', 1)->get();
            $product_categories = $product_categories->map(function ($category) {
                return [
                    "title" => $category->title,
                    "url" => $category->url,
                    "overview" => $category->overview,
                    "image" => $category->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $category->image) : secure_asset('storage/' . $category->image)) : null,
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
                         "overview" => $category->overview,
                         "description" => Str::limit($category->description, 156, '...'),
                         "image" => secure_asset('storage/' . $category->image_small),
                         "services" => $services->map(function ($service) {
                          return [
                        "title" => $service->title,
                        "url" => $service->url,
                              ];
                }),
            ];
            });

            // Metadata
            $meta = Metadata::where('page_name', 'products')->first();

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "meta" => $meta,
                    "sectionData" => $sectionData,
                    "sliders" => $sliders,
                    "product_categories" => $segment_categories
                ]
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            return response($exception->getMessage(), 500);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function segment($slug)
    // {
    //     try {
    //         // Slider
    //         $sliders = Slider::where('page_name', 'products')
    //             ->where('visible', 1)
    //             ->orderBy('position', 'asc')
    //             ->get();
    //         $sliders = $sliders->map(function ($slider) {
    //             return [
    //                 "slogan" => $slider->slogan,
    //                 "slogan_color" => $slider->slogan_color,
    //                 "title" => $slider->title,
    //                 "title_color" => $slider->title_color,
    //                 "overview" => $slider->overview,
    //                 "overview_color" => $slider->overview_color,
    //                 "link" => $slider->link,
    //                 "link_text" => $slider->link_text,
    //                 "image" => $slider->image,
    //                 "image" => env('APP_ENV') == 'local' ? asset('storage/' . $slider->image) : secure_asset('storage/' . $slider->image),
    //             ];
    //         });

    //         // Segment get
    //         $segment = ProductSegment::where('url', $slug)
    //             ->where('visible', 1)->first();

    //         $total_solutions = $segment->solutions->count();
    //         $three_solutions = $segment->solutions->take(3);
    //         $solutions = $three_solutions->map(function ($segment) {
    //             return [
    //                 "title" => $segment->title,
    //                 "url" => $segment->url,
    //                 "description" => Str::limit($segment->description, 156, '...'),
    //                 "image" => $segment->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $segment->image) : secure_asset('storage/' . $segment->image)) : null,
    //             ];
    //         });

    //         $total_projects = $segment->projects->count();
    //         $three_projects = $segment->projects->take(3);
    //         $projects = $three_projects->map(function ($project) {
    //             return [
    //                 "title" => $project->title,
    //                 "url" => $project->url,
    //                 "description" => Str::limit($project->description, 156, '...'),
    //                 "image" => $project->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $project->image) : secure_asset('storage/' . $project->image)) : null,
    //             ];
    //         });

    //         $response = [
    //             "status" => 1,
    //             "message" => "success",
    //             "data" => [
    //                 "segment" => $segment,
    //                 "sliders" => $sliders,
    //                 "solutions" => $solutions,
    //                 "projects" => $projects,
    //                 "total_projects" => $total_projects,
    //                 "total_solutions" => $total_solutions
    //             ]
    //         ];
    //         return response($response, 200);
    //     } catch (Exception $exception) {
    //         // return $exception->getMessage();
    //         return response("Something went wrong.", 500);
    //     }
    // }

      public function segment($slug)
    {
        try {
            // Slider
            $sliders = Slider::where('page_name', 'products')
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

                     // Segment get
            $segment = ProductSegment::where('url', $slug)
                ->where('visible', 1)->first();


            // cat and Segment fix
            $category = ServiceCategory::where('url', $slug)->where('visible', true)->first();

            $segments = ProductSegment::where('category_id', $category->id)->get();
            $segments = $segments->map(function ($segment) {
                return [
                    "id" => $segment->id,
                    "name" => $segment->name,
                    "title" => $segment->title,
                    "url" => $segment->url,
                    "image" => $segment->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $segment->image) : secure_asset('storage/' . $segment->image)) : null,
                    "description" => $segment->description,
                    "overview" => $segment->overview,
                    "solution_overview" => $segment->solution_overview,
                    "project_overview" => $segment->project_overview,
                ];
            });


            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "sliders" => $sliders,
                    "category" => $category,
                    "segments" => $segments,
                    "segment" => $segment,
                ]
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            // return $exception->getMessage();
            return response("Something went wrong.", 500);
        }
    }

    public function works($slug)
    {
        try {
            // Slider
            $sliders = Slider::where('page_name', 'products')
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

            // Service Categories
            $industry = ProductSegment::with('projects')
                ->where('url', $slug)
                ->where('visible', 1)->first();

            $projects = $industry->projects->map(function ($project) {
                return [
                    "title" => $project->title,
                    "url" => $project->url,
                    "description" => Str::limit($project->description, 156, '...'),
                    "image" => $project->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $project->image) : secure_asset('storage/' . $project->image)) : null,
                ];
            });

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "industry" => $industry,
                    "sliders" => $sliders,
                    "projects" => $projects
                ]
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            // return $exception->getMessage();
            return response("Something went wrong.", 500);
        }
    }
    public function solutions($slug)
    {
        try {
            // Slider
            $sliders = Slider::where('page_name', 'products')
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

            // Service Categories
            $industry = ProductSegment::with('solutions')
                ->where('url', $slug)
                ->where('visible', 1)->first();

            $segments = $industry->solutions->map(function ($segment) {
                return [
                    "title" => $segment->title,
                    "url" => $segment->url,
                    "description" => Str::limit($segment->description, 156, '...'),
                    "image" => $segment->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $segment->image) : secure_asset('storage/' . $segment->image)) : null,
                ];
            });

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "industry" => $industry,
                    "sliders" => $sliders,
                    "segments" => $segments
                ]
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            // return $exception->getMessage();
            return response("Something went wrong.", 500);
        }
    }

    /**
     * Show the solution details.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function solutionDetails($slug)
    {
        try {
            $solution = SegmentSolution::where('url', $slug)
                ->where('visible', true)
                ->firstOrFail();

            $categories = BlogCategory::where('visible', true)->where('language','en')->get();
            $categories = $categories->map(function ($item) {
                return [
                    "title" => $item->title,
                    "url" => $item->url,
                ];
            });

            $relatedSolutions = $solution->product_segment->solutions()->where('visible', true)->where('id', '!=', $solution->id)->inRandomOrder()->get()->take(10);
            $relatedSolutions = $relatedSolutions->map(function ($solution) {
                return [
                    'created_at' => $solution->created_at->format('M d, Y'),
                    'duration' => readingTime($solution->article),
                    "title" => $solution->title,
                    "url" => $solution->url,
                    "author" => $solution->author->name ?? ''
                ];
            });

            $solution = [
                'category' => $solution->product_segment,
                'created_at' => $solution->created_at->format('M d, Y'),
                'duration' => readingTime($solution->article),
                'title' => $solution->title,
                'url' => $solution->url,
                'article' => $solution->article,
                "meta_title" => $solution->meta_title,
                "meta_description" => $solution->meta_description,
                "meta_keywords" => $solution->meta_keywords,
                "author" => [
                    "name" => $solution->author->name,
                    "designation" => $solution->author->designation,
                    "image" => $solution->author->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $solution->author->image_medium) : secure_asset('storage/' . $solution->author->image_medium)) : asset('/images/dummy-profile-pic-male.jpg')
                ],
                'image' => env('APP_ENV') == 'local' ? asset('storage/' . $solution->image) : secure_asset('storage/' . $solution->image),
            ];

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "post" => $solution,
                    "relatedPosts" => $relatedSolutions,
                    "categories" => $categories,
                    "tags" => $this->tags()
                ]
            ];

            return response($response, 200);
        } catch (Exception $exception) {
            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "post" => '',
                    "relatedPosts" => '',
                    "categories" => '',
                    "tags" => ''
                ]
            ];

            return response($response, 200);
        }
    }
    public function productDetails($slug)
    {
        try {
            
            // get 1 product segment by slug = url

            $segment = ProductSegment::where('url', $slug)
                ->where('visible', true)
                ->firstOrFail();

              $segment->image = $segment->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $segment->image) : secure_asset('storage/' . $segment->image)) : null;

              //get segments category info and related segments

                $category = ServiceCategory::where('id', $segment->category_id)->where('visible', true)->first();


            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "segment" => $segment,
                    "category" => $category,
                    "post" => '',
                    "relatedPosts" => '',
                    "categories" => '',
                    "tags" => ''
                ]
            ];

            return response($response, 200);
        } catch (Exception $exception) {
            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "post" => '',
                    "relatedPosts" => '',
                    "categories" => '',
                    "tags" => ''
                ]
            ];

            return response($response, 200);
        }
    }

    /**
     * Show the work details.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function workDetails($slug)
    {
        try {
            $project = SegmentProject::where('url', $slug)
                ->where('visible', true)
                ->firstOrFail();

            $categories = BlogCategory::where('visible', true)->where('language', 'en')->get();
            $categories = $categories->map(function ($item) {
                return [
                    "title" => $item->title,
                    "url" => $item->url,
                ];
            });

            $relatedProjects = $project->product_segment->projects()->where('visible', true)->where('id', '!=', $project->id)->inRandomOrder()->get()->take(10);
            $relatedProjects = $relatedProjects->map(function ($project) {
                return [
                    'created_at' => $project->created_at->format('M d, Y'),
                    'duration' => readingTime($project->article),
                    "title" => $project->title,
                    "url" => $project->url,
                    "author" => $project->author->name ?? ''
                ];
            });

            $project = [
                'category' => $project->product_segment,
                'created_at' => $project->created_at->format('M d, Y'),
                'duration' => readingTime($project->article),
                'title' => $project->title,
                'url' => $project->url,
                'article' => $project->article,
                "meta_title" => $project->meta_title,
                "meta_description" => $project->meta_description,
                "meta_keywords" => $project->meta_keywords,
                "author" => [
                    "name" => $project->author->name,
                    "designation" => $project->author->designation,
                    "image" => $project->author->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $project->author->image_medium) : secure_asset('storage/' . $project->author->image_medium)) : asset('/images/dummy-profile-pic-male.jpg')
                ],
                'image' => env('APP_ENV') == 'local' ? asset('storage/' . $project->image) : secure_asset('storage/' . $project->image),
            ];

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "post" => $project,
                    "relatedPosts" => $relatedProjects,
                    "categories" => $categories,
                    "tags" => $this->tags()
                ]
            ];

            return response($response, 200);
        } catch (Exception $exception) {
            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "post" => '',
                    "relatedPosts" => '',
                    "categories" => '',
                    "tags" => ''
                ]
            ];

            return response($response, 200);
        }
    }


    public function data()
    {
        try {
            // Slider
            $sliders = Slider::where('page_name', 'products')
                ->where('visible', 1)
                ->orderBy('position', 'asc')
                ->get();
            $sliders = $sliders->map(fn ($slider) => new SliderResource($slider));

            // Section Data
            $sectionData = SectionData::where('page', 'products')->get();
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

            // Brands
            $brands = Brand::where('visible', true)->get();
            $brands = $brands->map(fn ($brand) => new BrandResource($brand));

            // Promotions
            $promotions = ProductPromotion::where('visible', true)->get();
            $promotions = $promotions->map(function ($promotion) {
                return [
                    "title" => $promotion->title,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $promotion->image_medium) : secure_asset('storage/' . $promotion->image_medium),
                ];
            });

            // Products
            $products = Product::where('visible', true)->get()->take(20);
            $products = $products->map(function ($product) {
                return [
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $product->image_medium) : secure_asset('storage/' . $product->image_medium),
                    "title" => $product->title,
                    "url" => $product->url,
                    "price" => $product->price,
                    "regular_price" => $product->regular_price,
                ];
            });

            // Faqs
            $faqs = Faq::where('faq_for', 'products')->get();

            // Metadata
            $meta = Metadata::where('page_name', 'products')->first();

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "meta" => $meta,
                    "sectionData" => $sectionData,
                    "sliders" => $sliders,
                    "brands" => $brands,
                    "promotions" => $promotions,
                    "products" => $products,
                    "faqs" => $faqs,
                    "tags" => $this->tags(),
                    "expert" => $this->expert(),
                ]
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            return response($exception->getMessage(), 500);
        }
    }

    public function productsTmiData()
    {
        try {
            // Slider
            $sliders = Slider::where('page_name', 'products')
                ->where('visible', 1)
                ->orderBy('position', 'asc')
                ->get();
            $sliders = $sliders->map(fn ($slider) => new SliderResource($slider));

            // Section Data
            $sectionData = SectionData::where('page', 'products')->get();
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

            // Categories
            $categories = ProductCategory::where('visible', true)->get();
            $categories = $categories->map(function ($category) {
                return [
                    "title" => $category->title,
                    "url" => $category->url,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $category->image_medium_1) : secure_asset('storage/' . $category->image_medium_1),
                ];
            });

            // Brands
            $brands = Brand::where('visible', true)
            ->get();
            $brands = $brands->map(fn ($brand) => new BrandResource($brand));

            // Promotions
            $promotions = ProductPromotion::where('visible', true)->get();
            $promotions = $promotions->map(function ($promotion) {
                return [
                    "title" => $promotion->title,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $promotion->image_medium) : secure_asset('storage/' . $promotion->image_medium),
                ];
            });

            // Team
            $supports=Team::where('support',1)->get()->take(3);


               // trendy slider
            $trendy_sliders = Slider::where('page_name', 'trendy-banner')
               ->where('visible', 1)
               ->take(3)
               ->orderBy('position', 'asc')
               ->get();
            $trendy_sliders = $trendy_sliders->map(fn ($slider) => new SliderResource($slider));

            // Products
            $trendy_products = Product::where('visible', true)
            ->where('views', '>', 1000)
            ->take(3)
            ->get();
            $trendy_products = $trendy_products->map(function ($product) {
                return [
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $product->image_medium) : secure_asset('storage/' . $product->image_medium),
                    "title" => $product->title,
                    "short_description" => $product->short_description,
                    "url" => $product->url,
                    "price" => $product->price,
                    "regular_price" => $product->regular_price,
                ];
            });


            // popular products

            $featured_products = Product::where('visible', true)
            // where ('featured', 1)
            ->where('featured', 1)
            ->get();
            $featured_products = $featured_products->map(function ($product) {
                return [
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $product->image_medium) : secure_asset('storage/' . $product->image_medium),
                    "title" => $product->title,
                    "short_description" => $product->short_description,
                    "url" => $product->url,
                    "price" => $product->price,
                    "regular_price" => $product->regular_price,
                ];
            });

            // Faqs
            $faqs = Faq::where('faq_for', 'products')->get();

            // Metadata
            $meta = Metadata::where('page_name', 'products')->first();

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "meta" => $meta,
                    "sectionData" => $sectionData,
                    "sliders" => $sliders,
                    "categories" => $categories,
                    "brands" => $brands,
                    "promotions" => $promotions,
                    "trendy_sliders" => $trendy_sliders,
                    "trendy_products" => $trendy_products,
                    "featured_products" => $featured_products,
                    "faqs" => $faqs,
                    "supports" => $supports,
                    "tags" => $this->tags(),
                    "expert" => $this->expert(),
                ]
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            return response($exception->getMessage(), 500);
        }
    }


    public function trending()
    {
        $products = Product::where('visible', true)
            ->orderBy('views', 'desc')
            ->inRandomOrder()
            ->get()
            ->take(3);
        $products = $products->map(function ($product) {
            return [
                "title" => $product->title,
                "url" => $product->url,
                "views" => $product->views,
                "image" => env('APP_ENV') == 'local' ? asset('storage/' . $product->image) : secure_asset('storage/' . $product->image)
            ];
        });

        return response($products, 200);
    }

    public function categories()
    {
        $categories = ProductCategory::where('visible', true)->get();
        $categories = $categories->map(function ($category) {
            return [
                "title" => $category->title,
                "url" => $category->url,
                "image" => env('APP_ENV') == 'local' ? asset('storage/' . $category->image) : secure_asset('storage/' . $category->image),
            ];
        });

        return response($categories, 200);
    }


    public function brands()
    {
        $brands = Brand::where('visible', true)->get();
        $brands = $brands->map(function ($brand) {
            return [
                "title" => $brand->title,
                "url" => $brand->url,
                "image" => env('APP_ENV') == 'local' ? asset('storage/' . $brand->image) : secure_asset('storage/' . $brand->image),
            ];
        });

        return response($brands, 200);
    }


    public function loadmore()
    {
        // Products
        $products = Product::where('visible', true)->paginate(20);
        $modifiedProducts = $products->getCollection()->map(function ($product) {
            return [
                "image" => env('APP_ENV') == 'local' ? asset('storage/' . $product->image_medium) : secure_asset('storage/' . $product->image_medium),
                "title" => $product->title,
                "url" => $product->url,
                "price" => $product->price,
                "regular_price" => $product->regular_price,
            ];
        });

        $response = [
            "products" => $modifiedProducts,
            "next_page" => $products->toArray()['next_page_url']
        ];

        return response($response, 200);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search($keyword)
    {
        $products = Product::whereHas('brand')
            ->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%$keyword%")
                    ->orWhere('overview', 'like', "%$keyword%");
            })
            ->get();

        $products = $products->map(function ($product) {
            return [
                "image" => env('APP_ENV') == 'local' ? asset('storage/' . $product->image_medium) : secure_asset('storage/' . $product->image_medium),
                "title" => $product->title,
                "url" => $product->url,
                "price" => $product->price,
                "regular_price" => $product->regular_price,
            ];
        });

        return response($products, 200);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($url)
    {
        try {
            $trending = Product::where('visible', true)
                ->orderBy('views', 'desc')
                ->inRandomOrder()
                ->get()
                ->take(4);
            $trending = $trending->map(function ($product) {
                return [
                    "title" => $product->title,
                    "url" => $product->url,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $product->image) : secure_asset('storage/' . $product->image)
                ];
            });

            // Faqs
            $faqs = Faq::where('faq_for', $url)->get();

            $product = Product::with('images')->where('url', $url)
                ->where('visible', true)
                ->firstOrFail();

            $product->increment('views');
            $product->save();

            $relatedProducts = $product->category->products()->where('visible', true)->inRandomOrder()->get()->take(4);
            $relatedProducts = $relatedProducts->map(function ($product) {
                return [
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $product->image_medium) : secure_asset('storage/' . $product->image_medium),
                    "title" => $product->title,
                    "url" => $product->url,
                    "price" => $product->price,
                    "regular_price" => $product->regular_price,
                ];
            });

            $product = [
                "brand" => [
                    "title" => $product->brand->title,
                    "url" => $product->brand->url,
                ],
                "branch" => $product->branch ? [
                    "title" => $product->branch->title,
                    "url" => $product->branch->url,
                ] : null,
                "category" =>  [
                    "title" => $product->category->title,
                    "url" => $product->category->url,
                ],
                "subcategory" => $product->subcategory ?  [
                    "title" => $product->subcategory->title,
                    "url" => $product->subcategory->url,
                ] : null,
                "title" => $product->title,
                "id" => $product->id,
                "url" => $product->url,
                "price" => $product->price,
                "regular_price" => $product->regular_price,
                "quantity" => $product->quantity,
                "short_description" => $product->short_description,
                "overview" => $product->overview,
                "features" => $product->features,
                "specifications" => $product->specifications,
                "includes" => $product->includes,
                "accessories" => $product->accessories,
                "meta_title" => $product->meta_title,
                "meta_description" => $product->meta_description,
                "meta_keywords" => $product->meta_keywords,
                "image" => env('APP_ENV') == 'local' ? asset('storage/' . $product->image) : secure_asset('storage/' . $product->image),
                "gallery" => $product->images->map(function ($gallery) {
                    return [
                        "title" => $gallery->title,
                        "path" => env('APP_ENV') == 'local' ? asset('storage/' . $gallery->image) : secure_asset('storage/' . $gallery->image),
                    ];
                }),
                "resources" => $product->resources()->where('visible', true)->get()->map(function ($datasheet) {
                    return [
                        "title" => $datasheet->title,
                        "path" => env('APP_ENV') == 'local' ? asset('storage/' . $datasheet->path) : secure_asset('storage/' . $datasheet->path),
                    ];
                }),
            ];
            
            //get all reviews for this product
            $reviews=Review::where('product_id',$product['id'])->get();

            $response = [
                "status" => true,
                "message" => "success",
                "data" => [
                    "faqs" => $faqs,
                    "product" => $product,
                    "trending" => $trending,
                    "relatedProducts" => $relatedProducts,
                    "reviews" => $reviews,
                ],
            ];

            return response()->json($response, 200);
        } catch (Exception $exception) {
            $response = [
                "status" => false,
                "message" => $exception->getMessage(),
            ];

            return response()->json($response, 500);
        }
    }

    public function tags()
    {
        $products = Product::select('meta_keywords')
            ->inRandomOrder()
            ->select('meta_keywords')
            ->take(5)
            ->get();
        $tags = [];
        foreach ($products as $product) {
            foreach (explode(",", $product->meta_keywords) as $tag) {
                if ($tag != "") {
                    $tags[] = $tag;
                }
            }
        }
        return $tags;
    }


    // Products - Brand - Category - Subcategory
    public function productsBrand($brand)
    {
        try {

            //meta 
            $meta = Metadata::where('page_name', "products")->first();
            // Brand
            $brand = Brand::where('url', $brand)->first();

            // Section Data
            $sectionData = SectionData::where('page', $brand->url)->get();
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
            $sliders = Slider::where('page_name', "category")
                ->where('visible', 1)
                ->orderBy('position', 'asc')
                ->get();
            $sliders = $sliders->map(fn ($slider) => new SliderResource($slider));

            // Categories
            $categories = $brand->categories()->where('visible', 1)->get();
            $categories = $categories->map(function ($category) use ($brand) {

                $image = $brand->url == "amprobe" ? $category->image_2 : $category->image_1;

                return [
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $image) : secure_asset('storage/' . $image),
                    "title" => $category->title,
                    "branch" => "Industrial Grade",
                    "url" => $category->url,
                    "description" => $category->description,
                    "meta_desciption" => $category->meta_desciption,
                ];
            });

            // Top Products
            $topProducts = $brand->products()
                ->where('visible', true)
                ->orderBy('views', 'desc')
                ->inRandomOrder()
                ->get()
                ->take(12);
            $topProducts = $topProducts->map(function ($product) {
                return [
                    "title" => $product->title,
                    "short_description" => $product->short_description,
                    "price" => $product->price,
                    "regular_price" => $product->regular_price,
                    "url" => $product->url,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $product->image) : secure_asset('storage/' . $product->image)
                ];
            });

            // Faqs
            $faqs = Faq::where('faq_for', "products")->get();

            // Team

            $supports=Team::where('support',1)->get()->take(3);

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "meta" => $meta,
                    "sliders" => $sliders,
                    "sectionData" => $sectionData,
                    "brand" => $brand,
                    "categories" => $categories,
                    "topProducts" => $topProducts,
                    "faqs" => $faqs,
                    "supports" => $supports,
                    "tags" => $this->tags(),
                    "expert" => $this->expert(),
                ]
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            return response($exception->getMessage(), 500);
        }
    }


    //productsCategory include all category products , category info, every brand list, meta , faqs, sliders, 

    public function productsCategory($category)
    {
        try {
            //meta 
            $meta = Metadata::where('page_name', "products")->first();
            // Category
            $category = ProductCategory::where('url', $category)->first();

            // Section Data
            $sectionData = SectionData::where('page', $category->url)->get();
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
            $sliders = Slider::where('page_name', $category->url)
                ->where('visible', 1)
                ->orderBy('position', 'asc')
                ->get();
            $sliders = $sliders->map(fn ($slider) => new SliderResource($slider));

            // Brands
            $brands = Brand::where('visible', 1)->get();
            $brands = $brands->map(function ($brand) {
                return [
                    "title" => $brand->title,
                    "url" => $brand->url,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $brand->image) : secure_asset('storage/' . $brand->image),
                ];
            });

            // Products
            $products = $category->products()
                ->where('visible', true)
                ->take(8)
                ->get();
            $products = $products->map(function ($product) {
                return [
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $product->image_medium) : secure_asset('storage/' . $product->image_medium),
                    "title" => $product->title,
                    "url" => $product->url,
                    "price" => $product->price,
                    "regular_price" => $product->regular_price,
                    "brand" => $product->brand->url,
                ];
            });

            // Faqs
            $faqs = Faq::where('faq_for', $category->url)->get();

           // Team
             $supports=Team::where('support',1)->get()->take(3);

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "meta" => $meta,
                    "sliders" => $sliders,
                    "sectionData" => $sectionData,
                    "category" => $category,
                    "brands" => $brands,
                    "products" => $products,
                    "faqs" => $faqs,
                    "supports" => $supports,
                    "tags" => $this->tags(),
                    "expert" => $this->expert(),
                ]
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            return response($exception->getMessage(), 500);
        }
    }



    

    

    public function productsBrandCategory($brand, $category)
    {
        try {
            //meta 
             $meta = Metadata::where('page_name', "products")->first();
            // Brand
            $brand = Brand::where('url', $brand)->first();

            // Slider
            $sliders = Slider::where('page_name', $category)
                ->where('visible', 1)
                ->orderBy('position', 'asc')
                ->get();
            $sliders = $sliders->map(fn ($slider) => new SliderResource($slider));

            // Category
            $category = ProductCategory::where('url', $category)->first();
            $modifiedCategory = [
                "title" => $category->title,
                "url" => $category->url,
                "description" => $category->description,
                "meta_title" => $category->meta_title,
                "meta_description" => $category->meta_description,
                "meta_keywords" => $category->meta_keywords,
                "image" => env('APP_ENV') == 'local' ? asset('storage/' . $category->image_medium) : secure_asset('storage/' . $category->image_medium),
            ];

            // Products
            $products = $category->products()
                ->where('brand_id', $brand->id)
                ->where('visible', true)
                ->get();
            $products = $products->map(function ($product) {
                return [
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $product->image_medium) : secure_asset('storage/' . $product->image_medium),
                    "title" => $product->title,
                    "url" => $product->url,
                    "price" => $product->price,
                    "regular_price" => $product->regular_price,
                ];
            });

            // Faqs
            $faqs = Faq::where('faq_for', $category->url)->get();

            // support

            $supports=Team::where('support',1)->get()->take(3);

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "meta" => $meta,
                    "sliders" => $sliders,
                    "category" => $modifiedCategory,
                    "products" => $products,
                    "faqs" => $faqs,
                    "tags" => $this->tags(),
                    "expert" => $this->expert(),
                    "supports" => $supports,
                ]
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            return response($exception->getMessage(), 500);
        }
    }

    public function productsSegment($segment)
    {
        try {

            // Slider
            $sliders = Slider::where('page_name', $segment)
                ->where('visible', 1)
                ->orderBy('position', 'asc')
                ->get();
            $sliders = $sliders->map(fn ($slider) => new SliderResource($slider));

            // Segment
            $segment = ProductSegment::where('url', $segment)->first();
            $modifiedSegment = [
                "title" => $segment->title,
                "url" => $segment->url,
                "description" => $segment->description,
                "meta_title" => $segment->meta_title,
                "meta_description" => $segment->meta_description,
                "meta_keywords" => $segment->meta_keywords,
                "image" => env('APP_ENV') == 'local' ? asset('storage/' . $segment->image_medium) : secure_asset('storage/' . $segment->image_medium),
            ];

            // Products
            $products = $segment->products()
                ->where('visible', true)
                ->get();
            $products = $products->map(function ($product) {
                return [
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $product->image_medium) : secure_asset('storage/' . $product->image_medium),
                    "title" => $product->title,
                    "url" => $product->url,
                    "price" => $product->price,
                    "regular_price" => $product->regular_price,
                ];
            });

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "sliders" => $sliders,
                    "segment" => $modifiedSegment,
                    "products" => $products,
                ]
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            return response($exception->getMessage(), 500);
        }
    }

    // post a review with name email phone rating comment 

    public function review(Request $request)
    {
        try {
            Review::create([
                "product_id" => intval($request->product_id),
                "name" => $request->name,
                "email" => $request->email,
                "number" => $request->number,
                "rating" => $request->rating,
                "comment" => $request->comment,
                "created_at" => now(),
            ]);

            // $reviews=Review::where('status',1)->get()->take(3);

            $response = [
                "status" => 1,
                "message" => "success",
                // "request" => $request->comment
                // "reviews" => $reviews
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            return response($exception->getMessage(), 500);
        }
    }

    public function expert()
    {
        // Experts
        $expert = Team::where('expert', 1)
            ->where('expert_in', 'product')
            ->where('visible', 1)
            ->inRandomOrder()
            ->first();
        if ($expert) {
            return [
                'name' => $expert->name,
                'email' => $expert->email,
                'phone' => $expert->phone,
                'image' => env('APP_ENV') == 'local' ? asset('storage/' . $expert->image) : secure_asset('storage/' . $expert->image),
            ];
        } else {
            return $expert;
        }
    }
}
