<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    public function index()
    {
        return view('main.home');
    }

    public function search()
    {
        return view('main.search');
    }


}
