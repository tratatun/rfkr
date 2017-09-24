<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Cover;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CoversController extends BaseController
{
    public function index()
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        return redirect()->route('admin.main');
    }

    public function create()
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        return view('admin.covers.create');
    }

    public function edit(Cover $cover)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        return view('admin.covers.edit', compact('cover'));
    }

    public function store(Request $request)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        $this->validator($request, true)->validate();

        Cover::create([
            'status' => 'shown',
            'title' => request('title'),
            'img' => request('img'),
            'text' => request('text', ''),
            'user_id' => Auth::id(),
            'updated_user_id' => Auth::id(),
            'img' => $request->file('img')->store('covers'),
        ]);

        return redirect()->route('admin.covers');
    }

    public function update(Request $request, Cover $cover)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        $this->validator($request)->validate();

        $cover->title = request('title');
        $cover->text = request('text', '');
        $cover->updated_user_id = Auth::id();

        if ($request->has('img')) {
            $img = $request->file('img')->store('covers');

            if ($img) {
                Storage::delete($cover->img);
                $cover->img = $img;
            }
        }

        $cover->save();

        return redirect()->route('admin.covers');

    }

    public function changeStatus(Cover $cover)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        $cover->status = request('status');
        $cover->save();

        return redirect()->route('admin.main');
    }

    public function delete(Cover $cover)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        if ($img = $cover->img) {
            Storage::delete($img);
        }

        $cover->delete();

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
        ];

        if ($checkImage || $request->has('img')) {
            $rules['img'] = 'required|mimetypes:image/jpeg, image/jpg, image/png';
        }

        return Validator::make($request->all(), $rules);
    }
}
