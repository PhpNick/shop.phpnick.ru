<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;
use Auth;
use App\Category;
use App\Brand;
use App\Product;
use App\Shipment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //Schema::defaultStringLength(191);
        View::share('Name',"Rick");
        View::composer('*',function($view){
            $categories = Category::with('children')->get();
            $categoriesMenu = Category::get()->groupBy('parent_id');
            $brands = Brand::get();
            $shipments = Shipment::get();
            $popularProducts = Product::where('popular', 1)->published()->get();
            $view->with('userData',Auth::user());
            $view->with('categories', $categories);
            $view->with('categoriesMenu', $categoriesMenu);
            $view->with('brands', $brands);
            $view->with('shipmentsGlobal', $shipments);
            $view->with('popularProducts', $popularProducts);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
