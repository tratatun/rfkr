<?php

namespace App\Http\Controllers\Admin;

use App\Treatment;

class TreatmentsController extends BaseController
{

    public function index()
    {
        $newTreatments = Treatment::newOnes()->get();
        $oldTreatments = Treatment::oldOnes()->get();

        return view('admin.treatments.index', compact('newTreatments', 'oldTreatments'));
    }

    public function showAnswer()
    {
        return view('admin.treatments.answer');
    }

    public function reviewAnswers()
    {
        return view('admin.treatments.review');
    }

    public function spam(Treatment $treatment)
    {
        $treatment->spam();

        return redirect()->route('admin.treatments');
    }
}