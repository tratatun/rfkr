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

    public function pages()
    {
        return view('admin.pages');
    }

    public function addPage()
    {
        return view('admin.page');
    }
}
