<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\SeoRecord;
use Illuminate\Support\Facades\Validator;

class SeoRecordsController extends BaseController
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

        return view('admin.seo-records.create');
    }

    public function edit(SeoRecord $seoRecord)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        return view('admin.seo-records.edit', compact('seoRecord'));
    }

    public function store(Request $request)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        $this->validator($request->all())->validate();

        SeoRecord::create([
            'status' => 'shown',
            'title' => request('title'),
            'text' => request('text'),
            'user_id' => Auth::id(),
            'updated_user_id' => Auth::id()
        ]);

        return redirect()->route('admin.seo-records');
    }

    public function update(Request $request, SeoRecord $seoRecord)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        $this->validator($request->all())->validate();

        $seoRecord->title = request('title');
        $seoRecord->text = request('text', '');
        $seoRecord->updated_user_id = Auth::id();

        $seoRecord->save();

        return redirect()->route('admin.seo-records');
    }

    public function changeStatus(SeoRecord $seoRecord)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        $seoRecord->status = request('status');
        $seoRecord->save();

        return redirect()->route('admin.main');
    }

    public function delete(SeoRecord $seoRecord)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        $seoRecord->delete();

        return redirect()->route('admin.main');
    }

    /**
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|max:255',
            'text' => 'required|string',
        ]);
    }
}
