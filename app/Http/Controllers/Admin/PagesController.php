<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;

class PagesController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        View::share('currentMenuItem', 'pages');
    }

    public function index()
    {
        return view('admin.pages.index');
    }

    public function create()
    {
        return view('admin.pages.create');
    }
}
