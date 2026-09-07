<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Blog;
use App\Models\Career;
use App\Models\Industry;
use App\Models\Product;
use App\Models\Service;
use App\Models\SolutionCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    const PER_TYPE_LIMIT = 8;
    const OVERALL_LIMIT = 30;
    const MIN_QUERY_LENGTH = 2;

    public function search(Request $request)
    {
        $term = trim((string) $request->input('keyword', $request->input('q', '')));

        if ($term === '') {
            return response()->json([
                'status' => 0,
                'message' => 'Search query is required.',
                'data' => [],
            ], 422);
        }

        if (mb_strlen($term) < self::MIN_QUERY_LENGTH) {
            return response()->json([
                'status' => 0,
                'message' => 'Search query must be at least ' . self::MIN_QUERY_LENGTH . ' characters.',
                'data' => [],
            ], 422);
        }

        try {
            $results = collect()
                ->merge($this->searchProducts($term))
                ->merge($this->searchWings($term))
                ->merge($this->searchIndustries($term))
                ->merge($this->searchSolutionCategories($term))
                ->merge($this->searchBlogs($term))
                ->merge($this->searchActivities($term))
                ->merge($this->searchCareers($term))
                ->take(self::OVERALL_LIMIT)
                ->values();

            return response()->json([
                'status' => 1,
                'message' => 'success',
                'data' => [
                    'query' => $term,
                    'total_results' => $results->count(),
                    'results' => $results,
                ],
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'status' => 0,
                'message' => 'Something went wrong while searching.',
                'data' => [],
            ], 500);
        }
    }

    private function searchProducts(string $term)
    {
        return Product::where('visible', 1)
            ->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                    ->orWhere('short_description', 'like', "%{$term}%")
                    ->orWhere('overview', 'like', "%{$term}%");
            })
            ->limit(self::PER_TYPE_LIMIT)
            ->get()
            ->map(function ($product) {
                return $this->result(
                    'product',
                    $product->title,
                    $product->short_description ?: $product->overview,
                    '/product/' . $product->url,
                    $product->image
                );
            });
    }

    private function searchWings(string $term)
    {
        return Service::where('visible', 1)
            ->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                    ->orWhere('slogan', 'like', "%{$term}%")
                    ->orWhere('article', 'like', "%{$term}%");
            })
            ->limit(self::PER_TYPE_LIMIT)
            ->get()
            ->map(function ($service) {
                return $this->result(
                    'wing',
                    $service->title,
                    $service->slogan ?: $service->article,
                    '/wings/' . $service->url,
                    $service->image
                );
            });
    }

    private function searchIndustries(string $term)
    {
        return Industry::with('category')
            ->where('visible', 1)
            ->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                    ->orWhere('description', 'like', "%{$term}%")
                    ->orWhere('article', 'like', "%{$term}%");
            })
            ->limit(self::PER_TYPE_LIMIT)
            ->get()
            ->filter(function ($industry) {
                // Skip rows with no category — their public URL can't be built without one.
                return $industry->category !== null;
            })
            ->map(function ($industry) {
                return $this->result(
                    'industry',
                    $industry->title,
                    $industry->description ?: $industry->article,
                    '/industries/' . $industry->category->url . '/' . $industry->url,
                    $industry->image
                );
            })
            ->values();
    }

    private function searchSolutionCategories(string $term)
    {
        return SolutionCategory::where('visible', 1)
            ->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                    ->orWhere('description', 'like', "%{$term}%");
            })
            ->limit(self::PER_TYPE_LIMIT)
            ->get()
            ->map(function ($category) {
                return $this->result(
                    'solution_category',
                    $category->title,
                    $category->description,
                    '/solutions/' . $category->url,
                    $category->image
                );
            });
    }

    private function searchBlogs(string $term)
    {
        return Blog::where('visible', 1)
            ->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                    ->orWhere('article', 'like', "%{$term}%");
            })
            ->limit(self::PER_TYPE_LIMIT)
            ->get()
            ->map(function ($blog) {
                return $this->result(
                    'blog',
                    $blog->title,
                    $blog->article,
                    '/blog/' . $blog->url,
                    $blog->image
                );
            });
    }

    private function searchActivities(string $term)
    {
        return Activity::where('visible', 1)
            ->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                    ->orWhere('article', 'like', "%{$term}%");
            })
            ->limit(self::PER_TYPE_LIMIT)
            ->get()
            ->map(function ($activity) {
                return $this->result(
                    'activity',
                    $activity->title,
                    $activity->article,
                    '/activity/' . $activity->url,
                    $activity->image
                );
            });
    }

    private function searchCareers(string $term)
    {
        return Career::where('visible', 1)
            ->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                    ->orWhere('description', 'like', "%{$term}%");
            })
            ->limit(self::PER_TYPE_LIMIT)
            ->get()
            ->map(function ($career) {
                return $this->result(
                    'career',
                    $career->title,
                    $career->description,
                    '/career/' . $career->url,
                    $career->image
                );
            });
    }

    private function result(string $type, string $title, ?string $excerptSource, string $url, ?string $image)
    {
        return [
            'type' => $type,
            'title' => $title,
            'excerpt' => Str::limit(trim(strip_tags($excerptSource ?? '')), 160),
            'url' => $url,
            'image' => $image ? (env('APP_ENV') == 'local' ? asset('storage/' . $image) : secure_asset('storage/' . $image)) : null,
        ];
    }
}
