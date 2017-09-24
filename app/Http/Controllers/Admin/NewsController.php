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

        return view('admin.news.create');
    }

    public function edit(News $news)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        return view('admin.news.edit', compact('news'));
    }

    public function store(Request $request)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

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
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

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
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

        $news->status = request('status');
        $news->save();

        return redirect()->route('admin.main');
    }

    public function delete(News $news)
    {
        if (!$this->isUserAuthor()) {
            return $this->getRedirectByRole();
        }

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
