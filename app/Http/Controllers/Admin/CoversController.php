<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Cover;
use Illuminate\Support\Facades\Validator;

class CoversController extends BaseController
{
    public function index()
    {
        return redirect()->route('admin.main');
    }

    public function create()
    {
        return view('admin.covers.create');
    }

    public function edit(Cover $cover)
    {
        return view('admin.covers.edit', compact('cover'));
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        Cover::create([
            'title' => request('title'),
            'img' => request('img'),
            'text' => request('text', ''),
            'user_id' => Auth::id(),
            'updated_user_id' => Auth::id()
        ]);

        return redirect()->route('admin.covers');
    }

    public function update(Request $request, Cover $cover)
    {
        $this->validator($request->all())->validate();

        $cover->title = request('title');
        $cover->text = request('text', '');
        $cover->img = request('img');
        $cover->updated_user_id = Auth::id();

        $cover->save();

        return redirect()->route('admin.covers');

    }

    /**
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|max:255',
            'img' => 'required|string|max:255',
        ]);
    }
}
