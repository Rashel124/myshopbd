<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Setting;
use App\Models\SubCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function($view){
            $view->with('cartProduct', Cart::where('ip_address', request()->ip())->with('product')->get());
            $view->with('cartProductCount', Cart::where('ip_address', request()->ip())->count());
            $view->with('unicCategory', Category::orderBy('name', 'asc')->with('subCategory')->get());
            $view->with('unicSubCategory', SubCategory::orderBy('name', 'asc')->get());
            $view->with('sitesetting', Setting::first());
        });
    }
}
