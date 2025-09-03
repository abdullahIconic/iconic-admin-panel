<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Activity;
use App\Models\Offer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $services = Service::count();
        $servicesHidden = Service::where('visible', 1)->count();

        $products = Product::count();
        $productsHidden = Product::where('visible', 1)->count();

        $blogs = Blog::count();
        $blogsHidden = Blog::where('visible', 1)->count();

        $activities = Activity::count();
        $activitiesHidden = Activity::where('visible', 1)->count();

        $offers = Offer::count();
        $offersHidden = Offer::where('visible', 1)
            ->where('starting_date', '<=', now())
            ->where('ending_date', '>=', now())
            ->count();

        return view('panel.dashboard', [
            "services" => [
                "visible" => $services,
                "hidden" => $servicesHidden,
            ],
            "products" => [
                "visible" => $products,
                "hidden" => $productsHidden,
            ],
            "blogs" => [
                "visible" => $blogs,
                "hidden" => $blogsHidden,
            ],
            "activities" => [
                "visible" => $activities,
                "hidden" => $activitiesHidden,
            ],
            "offers" => [
                "visible" => $offers,
                "hidden" => $offersHidden,
            ]
        ]);
    }
}
