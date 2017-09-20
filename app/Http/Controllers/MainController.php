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
        $covers = Cover::all();
        $news = News::query()->latest()->limit(8)->get();
        $govResources = GovResource::all();
        $sliders = Slider::all();
        $seoRecords = SeoRecord::query()->latest()->limit(8)->get();

        return view('main.home', compact('covers', 'news', 'govResources', 'sliders', 'seoRecords'));
    }

    public function search()
    {
        return view('main.search');
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