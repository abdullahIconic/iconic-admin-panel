<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// Route::get('/clear', function(){
//   Artisan::call('optimize:clear');
//   return 'Cache cleared!';
// });

// Controller
Route::middleware('auth')
    ->namespace('App\Http\Controllers')
    ->group(function () {
        Route::get('/', 'HomeController@dashboard')->name('dashboard');

        Route::resource('services', ServiceController::class)->only(['store', 'update']);
        Route::prefix('services')
            ->name('services.')
            ->group(function () {
                Route::resource('categories', ServiceCategoryController::class)->only(['store', 'update']);
                Route::resource('subcategories', ServiceSubcategoryController::class)->only(['store', 'update']);
                Route::resource('best-feature-images', BestFeatureImageController::class)->only(['store', 'update']);
                Route::resource('what-we-delivered', ServiceWwdController::class)->only(['store', 'update']);
                Route::resource('safety', ServiceSafetyController::class)->only(['store', 'update']);
            });

        Route::prefix('lps')
            ->name('lps.')
            ->group(function () {
                Route::resource('cards', LpsCardController::class)->only(['store', 'update']);
                Route::resource('materials', LpsMaterialController::class)->only(['store', 'update']);
            });

        Route::resource('products', ProductController::class)->only(['store', 'update']);
        Route::prefix('products')
            ->name('products.')
            ->group(function () {
                Route::resource('brands', BrandController::class)->only(['store', 'update']);
                Route::resource('branches', BrandBranchController::class)->only(['store', 'update']);
                Route::resource('categories', ProductCategoryController::class)->only(['store', 'update']);
                Route::resource('subcategories', ProductSubCategoryController::class)->only(['store', 'update']);
                Route::resource('promotions', ProductPromotionController::class)->except(['index', 'show']);
                Route::resource('segments', ProductSegmentController::class)->only(['store', 'update']);
                Route::prefix('segments')
                    ->name('segments.')
                    ->group(function () {

                        Route::resource('categories', SegmentCategoryController::class)->only(['store', 'update']);
                        Route::resource('solutions', SegmentSolutionController::class)->only(['store', 'update']);
                        Route::resource('projects', SegmentProjectController::class)->only(['store', 'update']);
                    });
            });

        Route::resource('industries', IndustryController::class)->only(['store', 'update']);
        Route::prefix('industries')
            ->name('industries.')
            ->group(function () {
                Route::resource('categories', IndustryCategoryController::class)->only(['store', 'update']);
                Route::resource('best-feature-images', BestFeatureImageController::class)->only(['store', 'update']);
                Route::resource('solutions', IndustrySolutionController::class)->only(['store', 'update']);
                Route::resource('projects', IndustryProjectController::class)->only(['store', 'update']);
            });

        Route::resource('solutions', SolutionController::class)->only(['store', 'update']);
        Route::prefix('solutions')
            ->name('solutions.')
            ->group(function () {
                Route::resource('categories', SolutionCategoryController::class)->only(['store', 'update']);
                Route::resource('timeline', SolutionTimelineController::class)->only(['store', 'update']);
            });

        Route::resource('blogs', BlogController::class)->only(['store', 'update']);
        Route::prefix('blogs')
            ->name('blogs.')
            ->group(function () {
                Route::resource('categories', BlogController::class)->only(['store', 'update']);
            });

        Route::resource('activities', ActivityController::class)->only(['store', 'update']);
        Route::prefix('activities')
            ->name('activities.')
            ->group(function () {
                Route::resource('categories', BlogController::class)->only(['store', 'update']);
            });

        Route::resource('careers', CareerController::class)->only(['store', 'update']);
        Route::prefix('careers')
            ->name('careers.')
            ->group(function () {
                // Route::resource('categories', CareerCategoryController::class)->only(['store', 'update']);
            });

        Route::prefix('about')
            ->name('about.')
            ->group(function () {
                Route::resource('items', AboutItemController::class)->only(['store', 'update']);
            });
        Route::prefix('resource')
            ->name('resource.')
            ->group(function () {
                Route::resource('items', ResourceItemController::class)->only(['store', 'update']);
            });

        Route::resource('service-list', ServiceListController::class)->only(['store', 'update']);
        Route::resource('clients', ClientController::class)->only(['store', 'update']);
        Route::resource('growthpaths', GrowthPathController::class)->only(['store', 'update']);
        Route::resource('happy-clients', HappyClientController::class)->only(['store', 'update']);
        Route::resource('offers', OfferController::class)->only(['store', 'update']);
        Route::resource('popup', PopupController::class)->only(['store', 'update']);
        Route::resource('offer-banner', OfferBannerController::class)->only(['store', 'update']);
        Route::resource('sliders', SliderController::class)->only(['store', 'update']);
        Route::resource('team', TeamController::class)->only(['store', 'update']);
        Route::resource('section-data', SectionDataController::class)->only(['store', 'update']);
    });



// Livewire
Route::middleware('auth')
    ->namespace('App\Http\Livewire')
    ->group(function () {
        /* Service Routes */
        Route::namespace('Services')
            ->prefix('services')
            ->name('services.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{service}', Show::class)->name('show');
                Route::get('edit/{service}', Edit::class)->name('edit');

                Route::namespace('Categories')
                    ->prefix('categories')
                    ->name('categories.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{category}', Show::class)->name('show');
                        Route::get('edit/{category}', Edit::class)->name('edit');
                    });

                Route::namespace('Subcategories')
                    ->prefix('subcategories')
                    ->name('subcategories.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{subcategory}', Show::class)->name('show');
                        Route::get('edit/{subcategory}', Edit::class)->name('edit');
                    });

                Route::namespace('ServiceWwd')
                    ->prefix('what-we-delivered')
                    ->name('what-we-delivered.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{work}', Show::class)->name('show');
                        Route::get('edit/{work}', Edit::class)->name('edit');
                    });

                Route::namespace('Safety')
                    ->prefix('safety')
                    ->name('safety.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{safety}', Show::class)->name('show');
                        Route::get('edit/{safety}', Edit::class)->name('edit');
                    });

                Route::namespace('Rental')
                    ->prefix('rental')
                    ->name('rental.')
                    ->group(function () {
                        Route::namespace('Tab')
                            ->prefix('tabs')
                            ->name('tabs.')
                            ->group(function () {
                                Route::get('/', Index::class)->name('index');
                                Route::get('create', Create::class)->name('create');
                                Route::get('show/{tab}', Show::class)->name('show');
                                Route::get('edit/{tab}', Edit::class)->name('edit');
                            });
                    });
            });

        Route::namespace('ServiceLps')
            ->prefix('lps')
            ->name('lps.')
            ->group(function () {
                Route::namespace('Card')
                    ->prefix('cards')
                    ->name('cards.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{card}', Show::class)->name('show');
                        Route::get('edit/{card}', Edit::class)->name('edit');
                    });

                Route::namespace('Material')
                    ->prefix('materials')
                    ->name('materials.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{material}', Show::class)->name('show');
                        Route::get('edit/{material}', Edit::class)->name('edit');
                    });
            });

        /* Industry Routes */
        Route::namespace('Industries')
            ->prefix('industries')
            ->name('industries.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{industry}', Show::class)->name('show');
                Route::get('edit/{industry}', Edit::class)->name('edit');

                     /* Industry Categories */
        Route::namespace('Categories')
        ->prefix('categories')
        ->name('categories.')
        ->group(function () {
            Route::get('/', Index::class)->name('index');
            Route::get('create', Create::class)->name('create');
            Route::get('show/{category}', Show::class)->name('show');
            Route::get('edit/{category}', Edit::class)->name('edit');
        });


                /* Industry Solutions */
                Route::namespace('Solutions')
                    ->prefix('solutions')
                    ->name('solutions.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{solution}', Show::class)->name('show');
                        Route::get('edit/{solution}', Edit::class)->name('edit');
                    });
                /* Industry Works */
                Route::namespace('Projects')
                    ->prefix('projects')
                    ->name('projects.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{project}', Show::class)->name('show');
                        Route::get('edit/{project}', Edit::class)->name('edit');
                    });
            });

        Route::namespace('Products')
            ->prefix('products')
            ->name('products.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{product}', Show::class)->name('show');
                Route::get('edit/{product}', Edit::class)->name('edit');

                Route::namespace('Brands')
                    ->prefix('brands')
                    ->name('brands.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{brand}', Show::class)->name('show');
                        Route::get('edit/{brand}', Edit::class)->name('edit');
                        Route::get('categories/{brand}', Categories::class)->name('categories');
                    });


                Route::namespace('Segments')
                    ->prefix('segments')
                    ->name('segments.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');

                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{segment}', Show::class)->name('show');
                        Route::get('edit/{segment}', Edit::class)->name('edit');
                        Route::get('products/{segment}', Products::class)->name('products');

                        /* segment category */
                        Route::namespace('Categories')
                            ->prefix('categories')
                            ->name('categories.')
                            ->group(function () {
                                Route::get('/', Index::class)->name('index');
                                Route::get('create', Create::class)->name('create');
                                Route::get('show/{category}', Show::class)->name('show');
                                Route::get('edit/{category}', Edit::class)->name('edit');
                            });
                        /* Product Solutions */
                        Route::namespace('Solutions')
                            ->prefix('solutions')
                            ->name('solutions.')
                            ->group(function () {
                                Route::get('/', Index::class)->name('index');
                                Route::get('create', Create::class)->name('create');
                                Route::get('show/{solution}', Show::class)->name('show');
                                Route::get('edit/{solution}', Edit::class)->name('edit');
                            });
                        /* Product Works */
                        Route::namespace('Projects')
                            ->prefix('projects')
                            ->name('projects.')
                            ->group(function () {
                                Route::get('/', Index::class)->name('index');
                                Route::get('create', Create::class)->name('create');
                                Route::get('show/{project}', Show::class)->name('show');
                                Route::get('edit/{project}', Edit::class)->name('edit');
                            });
                    });

                Route::namespace('Branches')
                    ->prefix('branches')
                    ->name('branches.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{branch}', Show::class)->name('show');
                        Route::get('edit/{branch}', Edit::class)->name('edit');
                    });

                Route::namespace('Categories')
                    ->prefix('categories')
                    ->name('categories.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{category}', Show::class)->name('show');
                        Route::get('edit/{category}', Edit::class)->name('edit');
                    });

                Route::namespace('Subcategories')
                    ->prefix('subcategories')
                    ->name('subcategories.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{subcategory}', Show::class)->name('show');
                        Route::get('edit/{subcategory}', Edit::class)->name('edit');
                    });

                Route::namespace('Promotions')
                    ->prefix('promotions')
                    ->name('promotions.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('show/{promotion}', Show::class)->name('show');
                    });
            });

        Route::namespace('Solutions')
            ->prefix('solutions')
            ->name('solutions.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{solution}', Show::class)->name('show');
                Route::get('edit/{solution}', Edit::class)->name('edit');

                Route::namespace('Categories')
                    ->prefix('categories')
                    ->name('categories.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{category}', Show::class)->name('show');
                        Route::get('edit/{category}', Edit::class)->name('edit');
                    });

                Route::namespace('SolutionItem')
                    ->prefix('solution-items')
                    ->name('solution-items.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{solution}', Show::class)->name('show');
                        Route::get('edit/{solution}', Edit::class)->name('edit');
                    });

                Route::get('timeline', Index::class)->name('timeline.index');
                Route::namespace('Timeline')
                    ->prefix('timeline')
                    ->name('timeline.')
                    ->group(function () {
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{timeline}', Show::class)->name('show');
                        Route::get('edit/{timeline}', Edit::class)->name('edit');
                    });
            });

        Route::namespace('Blogs')
            ->prefix('blogs')
            ->name('blogs.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{blog}', Show::class)->name('show');
                Route::get('edit/{blog}', Edit::class)->name('edit');

                Route::namespace('Categories')
                    ->prefix('categories')
                    ->name('categories.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{category}', Show::class)->name('show');
                        Route::get('edit/{category}', Edit::class)->name('edit');
                    });
            });

        Route::namespace('Activities')
            ->prefix('activities')
            ->name('activities.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{activity}', Show::class)->name('show');
                Route::get('edit/{activity}', Edit::class)->name('edit');

                Route::namespace('Categories')
                    ->prefix('categories')
                    ->name('categories.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{category}', Show::class)->name('show');
                        Route::get('edit/{category}', Edit::class)->name('edit');
                    });
            });

        Route::namespace('Clients')
            ->prefix('clients')
            ->name('clients.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{client}', Show::class)->name('show');
                Route::get('edit/{client}', Edit::class)->name('edit');
            });

        Route::namespace('GrowthPaths')
            ->prefix('growthpaths')
            ->name('growthpaths.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{growthpath}', Show::class)->name('show');
                Route::get('edit/{growthpath}', Edit::class)->name('edit');
            });

        Route::namespace('HappyClients')
            ->prefix('happy-clients')
            ->name('happy-clients.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{client}', Show::class)->name('show');
                Route::get('edit/{client}', Edit::class)->name('edit');
            });

        Route::namespace('Careers')
            ->prefix('careers')
            ->name('careers.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{career}', Show::class)->name('show');
                Route::get('edit/{career}', Edit::class)->name('edit');
            });

        Route::namespace('Contests')
            ->prefix('contests')
            ->name('contests.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{contest}', Show::class)->name('show');
                Route::get('edit/{contest}', Edit::class)->name('edit');
            });

        Route::namespace('Offers')
            ->prefix('offers')
            ->name('offers.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{offer}', Show::class)->name('show');
                Route::get('edit/{offer}', Edit::class)->name('edit');
                Route::get('products/{offer}', Products::class)->name('products');

                Route::namespace('Banners')
                    ->prefix('banners')
                    ->name('banners.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{banner}', Show::class)->name('show');
                        Route::get('edit/{banner}', Edit::class)->name('edit');
                    });
            });

        Route::namespace('Popup')
            ->prefix('popup')
            ->name('popup.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{popup}', Show::class)->name('show');
                Route::get('edit/{popup}', Edit::class)->name('edit');
            });

        Route::namespace('Sliders')
            ->prefix('sliders')
            ->name('sliders.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{slider}', Show::class)->name('show');
                Route::get('edit/{slider}', Edit::class)->name('edit');
            });

        Route::namespace('Team')
            ->prefix('team')
            ->name('team.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{team}', Show::class)->name('show');
                Route::get('edit/{team}', Edit::class)->name('edit');
            });

        Route::namespace('ServiceCarousel')
            ->prefix('service-carousel')
            ->name('service-carousel.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{carousel}', Show::class)->name('show');
                Route::get('edit/{carousel}', Edit::class)->name('edit');
            });

        Route::namespace('ServiceList')
            ->prefix('service-list')
            ->name('service-list.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{service}', Show::class)->name('show');
                Route::get('edit/{service}', Edit::class)->name('edit');
            });

        Route::namespace('Counter')
            ->prefix('counter')
            ->name('counter.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('edit/{counter}', Edit::class)->name('edit');
            });

        Route::namespace('Faq')
            ->prefix('faq')
            ->name('faq.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('edit/{faq}', Edit::class)->name('edit');
            });

        Route::namespace('About')
            ->prefix('about')
            ->name('about.')
            ->group(function () {
                Route::namespace('Items')
                    ->prefix('items')
                    ->name('items.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{item}', Show::class)->name('show');
                        Route::get('edit/{item}', Edit::class)->name('edit');
                    });
            });

        Route::namespace('Resource')
            ->prefix('resource')
            ->name('resource.')
            ->group(function () {
                Route::namespace('Items')
                    ->prefix('items')
                    ->name('items.')
                    ->group(function () {
                        Route::get('/', Index::class)->name('index');
                        Route::get('create', Create::class)->name('create');
                        Route::get('show/{item}', Show::class)->name('show');
                        Route::get('edit/{item}', Edit::class)->name('edit');
                    });
            });

        Route::namespace('SectionData')
            ->prefix('section-data')
            ->name('section-data.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{section}', Show::class)->name('show');
                Route::get('edit/{section}', Edit::class)->name('edit');
            });

        Route::namespace('Metadata')
            ->prefix('metadata')
            ->name('metadata.')
            ->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('create', Create::class)->name('create');
                Route::get('show/{data}', Show::class)->name('show');
                Route::get('edit/{data}', Edit::class)->name('edit');
            });

        Route::get('site-informations', SiteInformations::class)->name('siteinfos');
    });

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
