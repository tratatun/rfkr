<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends BaseController
{

    public function index()
    {
        if (!$this->isUserSuperAdmin()) {
            return $this->getRedirectByRole();
        }

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        if (!$this->isUserSuperAdmin()) {
            return $this->getRedirectByRole();
        }

        return view('admin.users.create', ['roles' => User::$roles]);
    }

    public function edit(User $user)
    {
        if (!$this->isUserSuperAdmin()) {
            return $this->getRedirectByRole();
        }

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => User::$roles
        ]);
    }

    public function update(Request $request, User $user)
    {
        if (!$this->isUserSuperAdmin()) {
            return $this->getRedirectByRole();
        }

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
        if (!$this->isUserSuperAdmin()) {
            return $this->getRedirectByRole();
        }

        $user->status = request('status');
        $user->save();

        return redirect()->route('admin.users');
    }

    public function loginAs(User $user)
    {
        if (!$this->isUserSuperAdmin()) {
            return $this->getRedirectByRole();
        }

        Auth::login($user);

        return redirect()->route('admin.main');
    }

    public function user()
    {
        if (!$this->isUserSuperAdmin()) {
            return $this->getRedirectByRole();
        }

        return view('admin.user');
    }
}