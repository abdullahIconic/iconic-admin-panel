<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Metadata;
use App\Models\SectionData;
use Exception;

class BlogController extends Controller
{
    public function data(Request $request)
    {
        try {
            // Section Data
            $sectionData = SectionData::where('page', 'blog')->get();
            $sectionData = $sectionData->map(function ($data) {
                return [
                    "page" => $data->page,
                    "section" => $data->section,
                    "title" => $data->title,
                    "url" => $data->url,
                    "label" => $data->label,
                    "slogan" => $data->slogan,
                    "overview" => $data->overview,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $data->image_medium) : secure_asset('storage/' . $data->image_medium),
                    "image_alt" => $data->image_alt,
                ];
            });

            // Featured Posts
            $featured = Blog::where('visible', true)
                ->when($request->language, function ($query) use ($request) {
                    return $query->where('language', $request->language);
                })
                ->where('isFeatured', true)
                ->orderBy('created_at', 'desc')
                ->get();
            $featured = $featured ? $featured->map(fn ($post) => new BlogResource($post)) : [];

            // Recent Posts
            $recent = Blog::where('visible', true)
                ->when($request->language, function ($query) use ($request) {
                    return $query->where('language', $request->language);
                })
                ->latest()
                ->get()
                ->take(4);
            $recent = $recent ? $recent->map(fn ($post) => new BlogResource($post)) : [];

            // Popular Posts
            $popular = Blog::where('visible', true)
                ->when($request->language, function ($query) use ($request) {
                    return $query->where('language', $request->language);
                })
                ->orderBy('views', 'desc')
                ->get()
                ->take(8);
            $popular = $popular ? $popular->map(fn ($post) => new BlogResource($post)) : null;

            // Random posts
            $random = Blog::where('visible', true)
                ->when($request->language, function ($query) use ($request) {
                    return $query->where('language', $request->language);
                })
                ->get();
            $random = $random->map(fn ($post) => new BlogResource($post));

            // Metadata
            $meta = Metadata::where('page_name', 'blogEn')->first();

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
        } catch (Exception $exception) {
            return response($exception->getMessage(), 500);
        }
    }

    public function postsByCategory($category)
    {
        try {

            $category = BlogCategory::where('url', $category)->where('visible', true)->firstOrFail();
            $posts = $category->posts()->where('visible', true)->get();
            $posts = $posts->map(function ($post) {
                return [
                    "category" => $post->category->title,
                    "title" => $post->title,
                    "url" => $post->url,
                    "meta_description" => $post->meta_description, //substr($post->meta_description, 0, 100),
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $post->image_medium) : secure_asset('storage/' . $post->image_medium),
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
        } catch (Exception $exception) {
            return response($exception->getMessage(), 500);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request, $url)
    {
        try {
            $blog = Blog::where('url', $url)
                ->where('visible', true)
                ->firstOrFail();

            $blog->increment('views');
            $blog->save();

            $categories = BlogCategory::where('visible', true)->where('language', $request->language ?? 'en')->get();
            $categories = $categories->map(function ($item) {
                return [
                    "title" => $item->title,
                    "url" => $item->url,
                ];
            });

            $relatedPosts = $blog->category->posts()->where('visible', true)->inRandomOrder()->get()->take(10);
            $relatedPosts = $relatedPosts->map(function ($post) {
                return [
                    'created_at' => $post->created_at->format('M d, Y'),
                    'duration' => readingTime($post->article),
                    "title" => $post->title,
                    "url" => $post->url,
                    "author" => $post->author->name ?? '',
                    "image" => env('APP_ENV') == 'local' ? asset('storage/' . $post->image_medium) : secure_asset('storage/' . $post->image_medium)
                ];
            });

            $post = [
                'category' => $blog->category,
                'created_at' => $blog->created_at->format('M d, Y'),
                'duration' => readingTime($blog->article),
                'title' => $blog->title,
                'url' => $blog->url,
                'article' => $blog->article,
                "meta_title" => $blog->meta_title,
                "meta_description" => $blog->meta_description,
                "meta_keywords" => $blog->meta_keywords,
                "author" => [
                    "name" => $blog->author->name,
                    "designation" => $blog->author->designation,
                    "image" => $blog->author->image ? (env('APP_ENV') == 'local' ? asset('storage/' . $blog->author->image_medium) : secure_asset('storage/' . $blog->author->image_medium)) : asset('/images/dummy-profile-pic-male.jpg')
                ],
                'image' => env('APP_ENV') == 'local' ? asset('storage/' . $blog->image) : secure_asset('storage/' . $blog->image),
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
        $blogs = Blog::select('meta_keywords')
            ->inRandomOrder()
            ->select('meta_keywords')
            ->take(1)
            ->get();
        $tags = [];
        foreach ($blogs as $blog) {
            foreach (explode(",", $blog->meta_keywords) as $tag) {
                if ($tag != "") {
                    $tags[] = $tag;
                }
            }
        }
        return $tags;
    }
}
