<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\Validator;

class NewsController extends BaseController
{
    public function index()
    {
        return redirect()->route('admin.main');
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        News::create([
            'status' => 'shown',
            'title' => request('title'),
            'url' => request('url'),
            'text' => request('text', ''),
            'user_id' => Auth::id(),
            'updated_user_id' => Auth::id()
        ]);

        return redirect()->route('admin.news');
    }

    public function update(Request $request, News $news)
    {
        $this->validator($request->all())->validate();

        $news->title = request('title');
        $news->url = request('url');
        $news->text = request('text', '');
        $news->updated_user_id = Auth::id();

        $news->save();

        return redirect()->route('admin.news');

    }

    public function changeStatus(News $news)
    {
        $news->status = request('status');
        $news->save();

        return redirect()->route('admin.main');
    }

    public function delete(News $news)
    {
        $news->delete();

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
