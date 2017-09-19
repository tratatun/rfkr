<?php

namespace App\Providers;

use App\GovResource;
use App\News;
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

        View::composer('main.parts.news', function ($view) {
            $news = News::query()->latest()->limit(8)->get();
            $view->with('news', $news);
        });

        View::composer('main.parts.gov-resources', function ($view) {
            $govResources = GovResource::all();
            $view->with('govResources', $govResources);
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
