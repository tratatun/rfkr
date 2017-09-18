<?php

namespace App\Http\Controllers\Admin;

use App\Treatment;

class TreatmentAnswersController extends BaseController
{

    public function create(Treatment $treatment)
    {
        return view('admin.treatment-answers.create', compact('treatment'));
    }

    public function index(Treatment $treatment)
    {
        return view('admin.treatment-answers.review', compact('treatment'));
    }

    public function store()
    {

    }
}