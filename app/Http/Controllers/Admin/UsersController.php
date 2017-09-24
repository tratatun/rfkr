<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends BaseController
{

    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = request()->all();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required|string',
            'password' => 'required|string|min:6'
        ];

        if (!$data['password']) {
            unset($rules['password']);
        }

        $request->validate($rules);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = $data['role'];

        if ($data['password']) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();

        return redirect()->route('admin.users');

    }

    public function changeStatus(User $user)
    {
        $user->status = request('status');
        $user->save();

        return redirect()->route('admin.users');
    }

    public function loginAs(User $user)
    {
        Auth::login($user);

        return redirect()->route('admin.main');
    }

    public function user()
    {
        return view('admin.user');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return [
            $this->username() => $request->get($this->username()),
            'password' => $request->get('password'),
//            'status' => 'active'
        ];
    }
}