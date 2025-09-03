<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\Metadata;
use App\Models\SectionData;
use Exception;
use Illuminate\Support\Facades\Log;

class ActivityController extends Controller
{
    public function data()
    {
        try{
            // Section Data
            $sectionData = SectionData::where('page', 'activities')->get();
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

            // Featured Posts
            $featured = Activity::where('visible', true)
                        ->where('isFeatured', true)
                        ->get();
            $featured = $featured->map(fn($post) => new ActivityResource($post));
            
            // Recent Posts
            $recent = Activity::where('visible', true)
                        ->latest()
                        ->get()
                        ->take(4);
            $recent = $recent->map(fn($post) => new ActivityResource($post));
            
            // Popular Posts
            $popular = Activity::where('visible', true)
                        ->orderBy('views', 'desc')
                        ->get()
                        ->take(8);
            $popular = $popular->map(fn($post) => new ActivityResource($post));

            // Random posts
            $random = Activity::where('visible', true)->get();
            $random = $random->map(fn($post) => new ActivityResource($post));

            // Metadata
            $meta = Metadata::where('page_name', 'activities')->first();

            // Response
            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "meta" => $meta,
                    "sectionData" => $sectionData,
                    "featured" => $featured,
                    "recent" => $recent,
                    "popular" => $popular,
                    "random" => $random,
                ]
            ];
            return response($response, 200);

        }
        catch(Exception $exception){
            Log::info($exception->getMessage());
            return response($exception->getMessage(), 500);
        }
    }
    
    public function postsByCategory($category)
    {
        try{
            
            $category = ActivityCategory::where('url', $category)->where('visible', true)->firstOrFail();
            $posts = $category->activities()->where('visible', true)->get();
            $posts = $posts->map(function($post){
                return [
                    "category" => $post->category->title,
                    "title" => $post->title,
                    "url" => $post->url,
                    "meta_description" => substr($post->meta_description,0,100),
                    "image" => env('APP_ENV') == 'local' ? asset('storage/'.$post->image_medium) : secure_asset('storage/'.$post->image_medium),
                ];
            });

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "category" => [
                        "title" => $category->title,
                        "url" => $category->url,
                    ],
                    "posts" => $posts,
                ]
            ];
            return response($response, 200);
        }
        catch(Exception $exception){
            return response($exception->getMessage(), 500);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($url)
    {
        try{
            $activity = Activity::where('url', $url)
                        ->where('visible', true)
                        ->firstOrFail();
                
            $activity->increment('views');
            $activity->save();

            $categories = ActivityCategory::where('visible', true)->get();
            $categories = $categories->map(function($item){
                return [
                    "title" => $item->title,
                    "url" => $item->url,
                ];
            });

            $relatedPosts = $activity->category->activities()->where('visible', true)->inRandomOrder()->get()->take(10);
            $relatedPosts = $relatedPosts->map(function($post){
                return [
                    'created_at' => $post->created_at->format('M d, Y'),
                    'duration' => readingTime($post->article),
                    "title" => $post->title,
                    "url" => $post->url,
                    "author" => $post->author->name,
                ];
            });

            $post = [
                'category' => $activity->category,
                'created_at' => $activity->created_at->format('M d, Y'),
                'duration' => readingTime($activity->article),
                'title' => $activity->title,
                'url' => $activity->url,
                'article' => $activity->article,
                "meta_title" => $activity->meta_title,
                "meta_description" => $activity->meta_description,
                "meta_keywords" => $activity->meta_keywords,
                "author" => [
                    "name" => $activity->author->name,
                    "image" => $activity->author->image_medium ? (env('APP_ENV') == 'local' ? asset('storage/'.$activity->author->image_medium) : secure_asset('storage/'.$activity->author->image)) : asset('/images/dummy-profile-pic-male.jpg')
                ],
                'image' => env('APP_ENV') == 'local' ? asset('storage/'.$activity->image) : secure_asset('storage/'.$activity->image),
            ];

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "post" => $post,
                    "relatedPosts" => $relatedPosts,
                    "categories" => $categories,
                    "tags" => $this->tags()
                ]
            ];

            return response($response, 200);
        }
        catch(Exception $exception){
            return response($exception->getMessage(), 500);
        }
    }

    public function tags()
    {
        $activities = Activity::select('meta_keywords')
                    ->inRandomOrder()
                    ->select('meta_keywords')
                    ->take(1)
                    ->get();
        $tags = [];
        foreach($activities as $activity){
            foreach(explode(",", $activity->meta_keywords) as $tag){
                if($tag != ""){
                    $tags[] = $tag;
                }
            }
        }
        return $tags;
    }
}
