<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Slider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
        $this->validator($request, true)->validate();

        Slider::create([
            'status' => 'shown',
            'title' => request('title'),
            'img' => request('img'),
            'text' => request('text', ''),
            'user_id' => Auth::id(),
            'updated_user_id' => Auth::id(),
            'img' => $request->file('img')->store('covers'),
        ]);

        return redirect()->route('admin.sliders');
    }

    public function update(Request $request, Slider $slider)
    {
        $this->validator($request)->validate();

        $slider->title = request('title');
        $slider->text = request('text', '');
        $slider->img = request('img');
        $slider->updated_user_id = Auth::id();

        if ($request->has('img')) {
            $img = $request->file('img')->store('covers');

            if ($img) {
                Storage::delete($slider->img);
                $slider->img = $img;
            }
        }

        $slider->save();

        return redirect()->route('admin.sliders');

    }

    public function changeStatus(Slider $slider)
    {
        $slider->status = request('status');
        $slider->save();

        return redirect()->route('admin.main');
    }

    public function delete(Slider $slider)
    {
        if ($img = $slider->img) {
            Storage::delete($img);
        }

        $slider->delete();

        return redirect()->route('admin.main');
    }

    /**
     * @param Request $request
     * @param  bool $checkImage
     * @return \Illuminate\Contracts\Validation\Validator
     * @internal param array $data
     */
    protected function validator(Request $request, $checkImage = false)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'text' => 'required|string',
        ];

        if ($checkImage || $request->has('img')) {
            $rules['img'] = 'required|mimetypes:image/jpeg, image/jpg, image/png';
        }

        return Validator::make($request->all(), $rules);
    }
}
