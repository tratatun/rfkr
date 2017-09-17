<?php

namespace App\Http\Controllers\Admin;


class TreatmentsController extends BaseController
{
    public function index()
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
}
