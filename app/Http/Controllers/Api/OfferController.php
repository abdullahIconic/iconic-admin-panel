<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Metadata;
use App\Models\Offer;
use App\Models\Faq;
use App\Models\OfferBanner;
use Illuminate\Http\Request;
use Exception;
use App\Models\Slider;
use Carbon\Carbon;

class OfferController extends Controller
{
    public function data(Request $request)
    {
        try{
            // Slider
            $sliders = Slider::where('page_name', 'offer')
                            ->where('visible', true)
                            ->orderBy('position', 'asc')
                            ->get();
            $sliders = $sliders->map(function($slider){
                return [
                    "slogan" => $slider->slogan,
                    "slogan_color" => $slider->slogan_color,
                    "title" => $slider->title,
                    "title_color" => $slider->title_color,
                    "overview" => $slider->overview,
                    "overview_color" => $slider->overview_color,
                    "link" => $slider->link,
                    "link_text" => $slider->link_text,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/'.$slider->image) : secure_asset('storage/'.$slider->image),
                ];
            });

            // OfferBanner
            $banner = OfferBanner::where('visible', true)->orderBy('id', 'desc')->first();
            $banner = $banner ? [
                "title" => $banner->title,
                "url" => $banner->url,
                "label" => $banner->label,
                "overview" => $banner->overview,
                "image" => env('APP_ENV') == 'local' ? asset('storage/'.$banner->image) : secure_asset('storage/'.$banner->image),
            ] : null;

            // Offer
            $offers = Offer::where('visible', true)
                            ->where('starting_date', '<=', now())
                            ->where('ending_date', '>=', now())
                            ->orderBy('id', 'desc')
                            ->get();

            $offers = $offers->map(function($slider){
                return [
                    "title" => $slider->title,
                    "url" => $slider->url,
                    "regular_price" => $slider->regular_price,
                    "price" => $slider->price,
                    "discount" => $slider->discount,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/'.$slider->image) : secure_asset('storage/'.$slider->image),
                ];
            });

            // Metadata
            $meta = Metadata::where('page_name', 'offer')->first();

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "meta" => $meta,
                    "sliders" => $sliders,
                    "banner" => $banner,
                    "offers" => $offers,
                ]
            ];
            return response($response, 200);
        }
        catch(Exception $exception){
            $response = [
                "status" => 0,
                "message" => "failed"
            ];
            return response($response, 500);
        }
    }


    public function raihan(Request $request)
    {
        try {
            // return response with status 
            $response = [
                "status" => 1,
                "message" => "success"
            ];
         
            return response($response, 200);
        } catch(Exception $exception){
            // Log the exception message
            Log::error($exception->getMessage());
    
            $response = [
                "status" => 0,
                "message" => "failed"
            ];
            return response($response, 500);
        }
    }

    
    
    public function show($url)
    {
        try{
            // Offer
            $offer = Offer::where('url', $url)
                        ->where('visible', true)
                        ->where('starting_date', '<=', now())
                        ->where('ending_date', '>=', now())
                        ->first();

            // Products
            $products = $offer->products()->where('visible', true)->get();
            $products = $products->map(function($product){
                return [
                    "title" => $product->title,
                    "url" => $product->url,
                    "image" => env('APP_ENV') == 'local' ? asset('storage/'.$product->image_small) : secure_asset('storage/'.$product->image_small),
                ];
            });
            $offer = [
                "title" => $offer->title,
                "url" => $offer->url,
                "regular_price" => $offer->regular_price,
                "price" => $offer->price,
                "discount" => $offer->discount,
                "ending_date" => Carbon::parse($offer->ending_date)->format('m/d/Y'),
                "image" => env('APP_ENV') == 'local' ? asset('storage/'.$offer->image) : secure_asset('storage/'.$offer->image),
            ];

            $response = [
                "status" => 1,
                "message" => "success",
                "data" => [
                    "offer" => $offer,
                    "products" => $products,
                ]
            ];
            return response($response, 200);
        }
        catch(Exception $exception){
            $response = [
                "status" => 0,
                "message" => "failed"
            ];
            return response($response, 200);
        }
    }
}
