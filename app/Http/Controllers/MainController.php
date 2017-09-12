<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('main.home');
    }

    public function agree()
    {
        return view('main.agree');
    }

    public function treatment()
    {
        return view('main.treatment');
    }

    public function search()
    {
        return view('main.search');
    }


}
