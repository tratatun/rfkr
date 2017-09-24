<?php

namespace App\Http\Controllers\Admin;

use App\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TreatmentAnswersController extends BaseController
{

    public function create(Treatment $treatment)
    {
        if (!$this->isUserSupport()) {
            return $this->getRedirectByRole();
        }

        return view('admin.treatment-answers.create', compact('treatment'));
    }

    public function index(Treatment $treatment)
    {
        if (!$this->isUserSupport()) {
            return $this->getRedirectByRole();
        }

        return view('admin.treatment-answers.review', compact('treatment'));
    }

    public function store(Request $request, Treatment $treatment)
    {
        if (!$this->isUserSupport()) {
            return $this->getRedirectByRole();
        }

        $request->validate([
            'text' => 'required|string'
        ]);

        $treatment->createAnswer([
            'text' => request('text'),
            'user_id' => Auth::id(),
        ]);

        if ($treatment->opened()) {
            $treatment->close();
        }

        return redirect()->route('admin.treatments');
    }
}