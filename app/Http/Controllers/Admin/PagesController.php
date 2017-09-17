<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Page;

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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:255',
            'url' => 'required|string|min:1|max:255',
        ]);

        Page::create([
            'title' => request('title'),
            'url' => request('url'),
            'text' => request('text', ''),
            'user_id' => Auth::id()
        ]);

        return redirect()->route('admin.pages');
    }
}
