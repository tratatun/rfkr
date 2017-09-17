<?php

namespace App\Http\Controllers\Admin;

class UsersController extends BaseController
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function user()
    {
        return view('admin.user');
    }
}