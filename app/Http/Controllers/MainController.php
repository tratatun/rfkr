<?php

namespace App\Http\Controllers;

use App\Cover;
use App\News;
use App\Page;

class MainController extends Controller
{
    public function index()
    {
        $covers = Cover::all();

        return view('main.home', compact('covers'));
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
