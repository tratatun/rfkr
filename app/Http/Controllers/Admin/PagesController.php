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
        $sections = Page::sections()->get();

        return view('admin.pages.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        Page::create([
            'title' => request('title'),
            'url' => request('url'),
            'text' => request('text', ''),
            'user_id' => Auth::id()
        ]);

        return redirect()->route('admin.pages');
    }

    public function storeSubPage(Request $request, Page $page)
    {
        $this->validator($request->all())->validate();

        $page->addSubPage([
            'title' => request('title'),
            'url' => request('url'),
            'text' => request('text', ''),
            'user_id' => Auth::id()
        ]);

        return redirect()->route('admin.pages');
    }

    public function update(Request $request, Page $page)
    {
        $this->validator($request->all())->validate();

        $page->title = request('title');
        $page->url = request('url');
        $page->text = request('text', '');

        $page->save();

        return redirect()->route('admin.pages');

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
