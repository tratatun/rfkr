<?php

namespace App\Http\Controllers\Admin;


class DefaultController extends BaseController
{
    public function index()
    {
        return redirect('/admin/pages');
    }
}