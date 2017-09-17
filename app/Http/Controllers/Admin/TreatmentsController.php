<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;

class TreatmentsController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        View::share('currentMenuItem', 'treatments');
    }

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
