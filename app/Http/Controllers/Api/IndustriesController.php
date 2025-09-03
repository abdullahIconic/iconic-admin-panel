<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Industry;
use App\Models\ServiceCategory;
use App\Models\IndustryProject;
use App\Models\IndustrySolution;
use App\Models\Metadata;
use App\Models\SectionData;
use Exception;
use App\Models\Slider;
use Illuminate\Support\Str;

class IndustriesController extends Controller
{
    public function data()
    {
        try {
            // Section Data
            $sectionData = SectionData::where('page', 'industries')->get();
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
            $sliders = Slider::where('page_name', 'industries')
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
            $meta = Metadata::where('page_name', 'industries')->first();

            // Service Categories
            $industries = Industry::where('visible', 1)->get();
            $industries = $industries->map(function ($industry) {
                return [
                    "title" => $industry->title,
                    "url" => $industry->url,
                    "description" => Str::limit($industry->description, 156, '...'),
                    "image" => $industry->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $industry->image) : secure_asset('storage/' . $industry->image)) : null,
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
             "description" => $category->description,
             "overview" => $category->overview,
             "image" => secure_asset('storage/' . $category->image_small),
             "services" => $services->map(function ($service) {
              return [
            "title" => $service->title,
            "url" => $service->url,
                  ];
    }),
];
            });
 
            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "meta" => $meta,
                    "sectionData" => $sectionData,
                    "sliders" => $sliders,
                    "industries" => $industries,
                    "industry_categories" => $industry_categories
                ]
            ];
            return response($response, 200);
        } catch (Exception $exception) {
            // return $exception->getMessage();
            return response("Something went wrong.", 500);
        }
    }

    public function industry($slug)
    {
        try {
            // Slider
            $sliders = Slider::where('page_name', 'industries')
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

            // Industry get
            $industry = Industry::where('url', $slug)
                ->where('visible', 1)->first();

            $total_solutions = $industry->solutions->count();
            $three_segments = $industry->solutions->take(3);
            $segments = $three_segments->map(function ($segment) {
                return [
                    "title" => $segment->title,
                    "url" => $segment->url,
                    "description" => Str::limit($segment->description, 156, '...'),
                    "image" => $segment->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $segment->image) : secure_asset('storage/' . $segment->image)) : null,
                ];
            });

            $total_projects = $industry->projects->count();
            $three_projects = $industry->projects->take(3);
            $projects = $three_projects->map(function ($project) {
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
                    "segments" => $segments,
                    "projects" => $projects,
                    "total_solutions" => $total_solutions,
                    "total_projects" => $total_projects
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
            $sliders = Slider::where('page_name', 'industries')
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
            $industry = Industry::with('projects')
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
            $sliders = Slider::where('page_name', 'industries')
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
            $industry = Industry::with('segments')
                ->where('url', $slug)
                ->where('visible', 1)->first();

            $segments = $industry->segments->map(function ($segment) {
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
            $solution = IndustrySolution::where('url', $slug)
                ->where('visible', true)
                ->firstOrFail();

            $categories = BlogCategory::where('visible', true)->where('language','en')->get();
            $categories = $categories->map(function ($item) {
                return [
                    "title" => $item->title,
                    "url" => $item->url,
                ];
            });

            $relatedSolutions = $solution->industry->solutions()->where('visible', true)->where('id', '!=', $solution->id)->inRandomOrder()->get()->take(10);
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
                'category' => $solution->industry,
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

    /**
     * Show the work details.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function workDetails($slug)
    {
        try {
            $project = IndustryProject::where('url', $slug)
                ->where('visible', true)
                ->firstOrFail();

            $categories = BlogCategory::where('visible', true)->where('language', 'en')->get();
            $categories = $categories->map(function ($item) {
                return [
                    "title" => $item->title,
                    "url" => $item->url,
                ];
            });

            $relatedProjects = $project->industry->projects()->where('visible', true)->where('id', '!=', $project->id)->inRandomOrder()->get()->take(10);
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
                'category' => $project->industry,
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

    public function tags()
    {
        $industries = Industry::select('meta_keywords')
            ->inRandomOrder()
            ->select('meta_keywords')
            ->take(1)
            ->get();
        $tags = [];
        foreach ($industries as $industry) {
            foreach (explode(",", $industry->meta_keywords) as $tag) {
                if ($tag != "") {
                    $tags[] = $tag;
                }
            }
        }
        return $tags;
    }
}
