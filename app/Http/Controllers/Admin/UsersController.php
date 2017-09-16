<?php

namespace App\Http\Controllers\Admin;

class UsersController extends BaseController
{
    public function users()
    {
        return view('admin.team');
    }
}