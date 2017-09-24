<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Page;
use Illuminate\Support\Facades\Validator;

class PagesController extends BaseController
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

        return view('admin.pages.create');
    }

    public function edit(Page $page)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        return view('admin.pages.edit', compact('page'));
    }

    public function store(Request $request)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        $this->validator($request->all())->validate();

        Page::create([
            'status' => 'shown',
            'title' => request('title'),
            'url' => request('url'),
            'text' => request('text', ''),
            'user_id' => Auth::id(),
            'updated_user_id' => Auth::id()
        ]);

        return redirect()->route('admin.main');
    }

    public function storeSubPage(Request $request, Page $page)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        $this->validator($request->all())->validate();

        $page->createSubPage([
            'status' => 'shown',
            'title' => request('title'),
            'url' => request('url'),
            'text' => request('text', ''),
            'user_id' => Auth::id(),
            'updated_user_id' => Auth::id()
        ]);

        return redirect()->route('admin.main');
    }

    public function changeStatus(Page $page)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        $page->status = request('status');
        $page->save();

        return redirect()->route('admin.main');
    }

    public function delete(Page $page)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        $page->delete();

        #todo: add check for children

        return redirect()->route('admin.main');
    }

    public function update(Request $request, Page $page)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        $this->validator($request->all())->validate();

        $page->title = request('title');
        $page->url = request('url');
        $page->text = request('text', '');
        $page->updated_user_id = Auth::id();

        $page->save();

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
