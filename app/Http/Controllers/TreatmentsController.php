<?php

namespace App\Http\Controllers;

use App\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TreatmentsController extends Controller
{
    public function rules()
    {
        return view('main.treatments.rules');
    }

    public function create()
    {
        if (!request('agree')) {
            return redirect()->route('treatments.rules');
        }

        return view('main.treatments.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'lastname' => 'required|string',
            'firstname' => 'required|string',
            'patronymic' => 'nullable|string',
            'gender' => 'nullable|string',
            'address' => 'required|string|min:3|max:255',
            'email' => 'required|string|email',
            'post_address' => 'nullable|string',
            'phone' => 'nullable|string',
            'thematic' => 'required|string',
            'message' => 'required|string|min:3|max:440',
            'file' => 'nullable|mimetypes:image/jpeg,image/png,text/plain,.doc,.docx,.p',
            'file_url' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->route('treatments.create', ['agree' => 1])
                ->withErrors($validator)
                ->withInput();
        }

        $data = request()->all();
        $data['status'] = Treatment::STATUS_OPENED;

        if ($request->has('file')) {
            $file = $request->file('file');

            $data['file'] = $file->store('treatments');
            $data['fileName'] = $file->getClientOriginalName();
        }

        Treatment::create($data);

        return redirect()->route('home');
    }

}
