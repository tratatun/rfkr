<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\GovResource;
use Illuminate\Support\Facades\Validator;

class GovResourcesController extends BaseController
{
    public function index()
    {
        return redirect()->route('admin.main');
    }

    public function create()
    {
        return view('admin.gov-resources.create');
    }

    public function edit(GovResource $govResource)
    {
        return view('admin.gov-resources.edit', compact('govResource'));
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        GovResource::create([
            'status' => 'shown',
            'title' => request('title'),
            'url' => request('url'),
            'user_id' => Auth::id(),
            'updated_user_id' => Auth::id()
        ]);

        return redirect()->route('admin.gov-resources');
    }

    public function update(Request $request, GovResource $govResource)
    {
        $this->validator($request->all())->validate();

        $govResource->title = request('title');
        $govResource->url = request('url');
        $govResource->updated_user_id = Auth::id();

        $govResource->save();

        return redirect()->route('admin.gov-resources');

    }

    public function changeStatus(GovResource $govResource)
    {
        $govResource->status = request('status');
        $govResource->save();

        return redirect()->route('admin.main');
    }

    public function delete(GovResource $govResource)
    {
        $govResource->delete();

        return redirect()->route('admin.main');
    }

    /**
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|min:3|max:255',
            'url' => 'required|string|min:1|max:255',
        ]);
    }
}
