<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\News;

class DefaultController extends BaseController
{
    public function index()
    {
        $sections = Page::sections()->get();
        $news = News::all();

        return view('admin.default.index', compact('sections', 'news'));
    }
}