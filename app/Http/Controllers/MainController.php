<?php

namespace App\Http\Controllers;

use App\Cover;
use App\News;
use App\Page;
use App\GovResource;
use App\SeoRecord;
use App\Slider;

class MainController extends Controller
{
    public function index()
    {
        $covers = Cover::shown()->get();
        $news = News::query()->shown()->latest()->limit(8)->get();
        $govResources = GovResource::shown()->get();
        $sliders = Slider::shown()->get();
        $seoRecords = SeoRecord::query()->shown()->latest()->limit(8)->get();

        return view('main.home', compact('covers', 'news', 'govResources', 'sliders', 'seoRecords'));
    }

    public function house()
    {
        return view('main.house');
    }

    public function search()
    {
        $query = request()->query('query');

        $news = News::query()->shown()->get();
        $pages = Page::query()->shown()->get();

        return view('main.search',compact('news', 'pages'));
    }


    public function showPage(Page $page)
    {
        return view('main.page', compact('page'));
    }

    public function showNews(News $news)
    {
        return view('main.newsOne', compact('news'));
    }
}