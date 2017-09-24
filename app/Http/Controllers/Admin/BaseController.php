<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function isUserAuthor()
    {
        if (Auth::user()->isSuperAdmin() || Auth::user()->isAuthor()) {
            return true;
        }

        return false;
    }

    protected function isUserSupport()
    {
        if (Auth::user()->isSuperAdmin() || Auth::user()->isSupport()) {
            return true;
        }

        return false;
    }

    protected function isUserSuperAdmin()
    {
        if (Auth::user()->isSuperAdmin()) {
            return true;
        }

        return false;
    }

    protected function getRedirectByRole()
    {
        switch(Auth::user()->role) {
            case User::ROLE_SUPPORT:
                $routeName = 'admin.treatments';
                break;
            default:
                $routeName = 'admin.main';
        }

        return redirect()->route($routeName);
    }
}