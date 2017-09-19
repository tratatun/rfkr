<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\News;
use App\GovResource;

class DefaultController extends BaseController
{
    public function index()
    {
        $sections = Page::sections()->get();
        $news = News::all();
        $govResources = GovResource::all();

        return view('admin.default.index', compact('sections', 'news', 'govResources'));
    }
}