<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\News;
use App\GovResource;
use App\Cover;
use App\SeoRecord;
use App\Slider;

class DefaultController extends BaseController
{
    public function index()
    {
        $sections = Page::sections()->get();
        $news = News::all();
        $govResources = GovResource::all();
        $covers = Cover::all();
        $sliders = Slider::all();
        $seoRecords = SeoRecord::all();

        $data = compact('sections', 'news', 'govResources', 'covers', 'sliders', 'seoRecords');

        return view('admin.default.index', $data);
    }
}