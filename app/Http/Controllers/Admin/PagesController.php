<?php

namespace App\Http\Controllers\Admin;

class PagesController extends BaseController
{
    public function pages()
    {
        return view('admin.pages');
    }

    public function addPage()
    {
        return view('admin.page');
    }
}
