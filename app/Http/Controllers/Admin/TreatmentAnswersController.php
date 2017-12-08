<?php

namespace App\Http\Controllers\Admin;

use Mail;
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

        $text = request('text');

        $treatment->createAnswer([
            'text' => $text,
            'user_id' => Auth::id(),
        ]);

        if ($treatment->opened()) {
            $treatment->close();
        }

        Mail::send('emails.treatment-answer', ['treatment' => $treatment, 'text' => $text], function ($m) use ($treatment) {
            $m->from('post@kaprem82.ru', 'Региональный Фонд Капитального Ремонта Многоквартирных Домов Республики Крым');

            $m->to($treatment->email, $treatment->firstname . '' . $treatment->firstname)->subject('Ответ на ваше обращение');
        });

        return redirect()->route('admin.treatments');
    }
}