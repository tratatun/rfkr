<?php

namespace App\Http\Controllers\Admin;

use App\Treatment;

class TreatmentsController extends BaseController
{

    public function index()
    {
        if (!$this->isUserSupport()) {
            return $this->getRedirectByRole();
        }

        $newTreatments = Treatment::newOnes()->get();
        $oldTreatments = Treatment::oldOnes()->get();

        return view('admin.treatments.index', compact('newTreatments', 'oldTreatments'));
    }

    public function showAnswer()
    {
        if (!$this->isUserSupport()) {
            return $this->getRedirectByRole();
        }

        return view('admin.treatments.answer');
    }

    public function reviewAnswers()
    {
        if (!$this->isUserSupport()) {
            return $this->getRedirectByRole();
        }

        return view('admin.treatments.review');
    }

    public function spam(Treatment $treatment)
    {
        if (!$this->isUserSupport()) {
            return $this->getRedirectByRole();
        }

        $treatment->spam();

        return redirect()->route('admin.treatments');
    }
}