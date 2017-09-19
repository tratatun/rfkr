<?php

namespace App\Http\Controllers;

use App\News;
use App\Page;

class MainController extends Controller
{
    public function index()
    {
        return view('main.home');
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
