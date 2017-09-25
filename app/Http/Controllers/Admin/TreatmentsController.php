<?php

namespace App\Http\Controllers\Admin;

use App\Treatment;
use App\User;
use Illuminate\Http\Request;

class TreatmentsController extends BaseController
{

    public function index(Request $request)
    {
        if (!$this->isUserSupport()) {
            return $this->getRedirectByRole();
        }

        $newTreatments = Treatment::newOnes()->get()->sortByDesc("created_at");
        $oldTreatments = Treatment::oldOnes();

        if ($status = $request->query('status')) {
            $oldTreatments = $oldTreatments->where('status', $status);
        }

        if ($dateFrom = $request->query('date_from')) {
            $oldTreatments = $oldTreatments->where('created_at', '>', $dateFrom);
        }

        if ($dateTo = $request->query('date_to')) {
            $oldTreatments = $oldTreatments->where('created_at', '<', $dateTo);
        }

        if ($userId = $request->query('user_id')) {

            $oldTreatments = $oldTreatments->whereHas('answers', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            });
        }

        $oldTreatments = $oldTreatments->get()->sortByDesc("updated_at");

        $users = User::all();

        return view('admin.treatments.index', compact('newTreatments', 'oldTreatments', 'users'));
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

    /**
     * Get the an author (admin) of the page.
     */
    public function userUpdated()
    {
        return $this->belongsTo(User::class, 'updated_user_id')->withDefault();
    }
}