<?php

namespace App\Providers;

use App\Models\category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        View::composer(['home','welcome'],function (){
            View::share('cat',Category::all());
        });

        Blade::directive('aps',function(){
            return "Aung Paing Soe";
        });

    }
}
