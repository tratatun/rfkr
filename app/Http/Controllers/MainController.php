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
}
