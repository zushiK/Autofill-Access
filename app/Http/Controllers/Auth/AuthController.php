<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * ログイン後リダイレクト先
     * @var string
     */
    protected $redirectTo = "/dashboard";

    /**
     * ログアウト後リダイレクト先
     * @var string
     */
    protected $redirectAfterLogout = "/";

    /**
     * Login
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function login()
    {
        if (auth()->check()) {
            return redirect($this->redirectTo);
        }
        return view("front.auth.login");
    }

    /**
     * Logout
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->logout();
        return redirect($this->redirectAfterLogout);
    }
}
