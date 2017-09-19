<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Slider;
use Illuminate\Support\Facades\Validator;

class SlidersController extends BaseController
{
    public function index()
    {
        return redirect()->route('admin.main');
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        Slider::create([
            'title' => request('title'),
            'img' => request('img'),
            'text' => request('text', ''),
            'user_id' => Auth::id(),
            'updated_user_id' => Auth::id()
        ]);

        return redirect()->route('admin.sliders');
    }

    public function update(Request $request, Slider $slider)
    {
        $this->validator($request->all())->validate();

        $slider->title = request('title');
        $slider->text = request('text', '');
        $slider->img = request('img');
        $slider->updated_user_id = Auth::id();

        $slider->save();

        return redirect()->route('admin.sliders');

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
            'text' => 'required|string',
        ]);
    }
}
