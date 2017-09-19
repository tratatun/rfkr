<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\News;
use App\GovResource;
use App\Cover;

class DefaultController extends BaseController
{
    public function index()
    {
        $sections = Page::sections()->get();
        $news = News::all();
        $govResources = GovResource::all();
        $covers = Cover::all();

        $data = compact('sections', 'news', 'govResources', 'covers');

        return view('admin.default.index', $data);
    }
}