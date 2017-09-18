<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Page;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['main.parts.topmenu', 'main.parts.footer'], function ($view) {
            $sections = Page::sections()->get();
            $view->with('sections', $sections);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Carbon::setLocale(config('app.locale'));
    }
}
