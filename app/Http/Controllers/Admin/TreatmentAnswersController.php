<?php

namespace App\Http\Controllers\Admin;

use App\Treatment;

class TreatmentAnswersController extends BaseController
{

    public function create()
    {
        return view('admin.treatments.answer');
    }

    public function store()
    {

    }

    public function index()
    {
        return view('admin.treatments.review');
    }
}