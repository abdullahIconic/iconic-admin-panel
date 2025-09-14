<?php

use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CareerController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\IndustriesController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SolutionController;
use App\Http\Controllers\Api\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Home
Route::controller(HomeController::class)
    ->group(function () {
        Route::get('home-page-data', 'data');
        Route::get('site-information', 'siteinfo');
    });

// Industries
Route::controller(IndustriesController::class)
    ->group(function () {
        Route::get('industries-page-data', 'data');
        Route::get('industries/{slug}', 'industry');
        Route::get('industries/solution-details/{slug}', 'solutionDetails');
        Route::get('industries/work-details/{slug}', 'workDetails');
        Route::get('industries/all-solutions/{slug}', 'solutions');
        Route::get('industries/all-works/{slug}', 'works');
    });

// Services
Route::controller(ServiceController::class)
    ->group(function () {
        Route::get('services-page-data', 'data');

        Route::get('services/category/{slug}', 'category');
        Route::get('services/subcategory/{slug}', 'subcategory');
        Route::get('industries/category/{category}', 'icategory');

        Route::get('services/details/{slug}', 'service');
        Route::get('industries/details/{service}', 'iservice');
    });

// Solutions
Route::controller(SolutionController::class)
    ->group(function () {
        Route::get('solution-page-data', 'data');
        Route::get('solutions/category/{url}', 'category');
    });

// Blogs
Route::controller(BlogController::class)
    ->group(function () {
        Route::get('blog-page-data/{language?}', 'data');
        Route::get('blogs/category/{category}', 'postsByCategory');
        Route::get('blogs/{url}', 'show');
    });

// Activities
Route::controller(ActivityController::class)
    ->group(function () {
        Route::get('activities-page-data', 'data');
        Route::get('activities/category/{category}', 'postsByCategory');
        Route::get('activities/{url}', 'show');
    });

// Career
Route::controller(CareerController::class)
    ->group(function () {
        Route::get('careers-page-data', 'data');
    });

// Products
Route::controller(ProductController::class)
    ->group(function () {
        Route::get('products-page-data', 'index');
        Route::get('products/{slug}', 'segment');
        Route::get('products/solution-details/{slug}', 'solutionDetails');
        Route::get('products/details/{slug}', 'productDetails'); // ASMFIX
        Route::get('products/work-details/{slug}', 'workDetails');
        Route::get('products/all-solutions/{slug}', 'solutions');
        Route::get('products/all-works/{slug}', 'works');
        //TMI PAGE
        Route::get('tmi-page-data', 'data');
        Route::get('products-tmi-page-data', 'productsTmiData');
        Route::get('products/tags', 'tags');
        // FIX_ASM
        Route::get('trending-products-data', 'trending');
        Route::get('products-categories', 'categories');
        Route::get('products-brands', 'brands');

        Route::get('products-loadmore', 'loadmore');
        Route::get('products/tmi/{url}', 'show');
        Route::get('products/tmi/search/{keyword}', 'search');

        Route::post('review', 'review');
    });

// Brands
Route::controller(ProductController::class)
    ->prefix('products')
    ->group(function () {
        // ASM Brand filter
        Route::get('brands/{brand}', 'productsBrand');
        Route::get('category/{category}', 'productsCategory');

        Route::get('brands/{brand}/{category}', 'productsBrandCategory');
        Route::get('segments/{segment}', 'productsSegment');


    });

// Offer
Route::controller(OfferController::class)
    ->group(function () {
        Route::get('offer-page-data', 'data');
        Route::get('offer-page-raihan', 'raihan');
        Route::get('offer/{url}', 'show');
    });

// Company
Route::get('team-page-data', [TeamController::class, 'data']);
Route::get('we-page-data', [AboutController::class, 'data']);
Route::get('resource-page-data', [ResourceController::class, 'data']);

Route::controller(ContactController::class)
    ->group(function () {
        Route::get('contact-page-data', 'data');
        Route::post('contact/send', 'send');
        Route::post('subscribe', 'subscribe');
    });
