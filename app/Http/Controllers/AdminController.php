<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function pages()
    {
        return view('admin.pages');
    }

    public function addPage()
    {
        return view('admin.page');
    }

    public function team()
    {
        return view('admin.team');
    }

    public function treatments()
    {
        return view('admin.treatments');
    }

    public function answerTreatment()
    {
        return view('admin.treatment-answer');
    }

    public function reviewTreatment()
    {
        return view('admin.treatment-review');
    }

    public function login()
    {
        return view('admin.login');
    }
}
