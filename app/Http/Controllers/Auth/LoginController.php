<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function username()
    {
        return 'phone';
    }

    public function login_show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('phone', 'password');

        $remember = isset($request->remember);

        if (Auth::attempt($credentials, $remember)) {
            // if success login
            return redirect('/');
        }
        // if failed login
        return redirect()->back()->withErrors(['danger' => 'نام کاربری و یا رمز عبور اشتباه است .']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->withErrors(['success' => 'با موفقیت خارج شدید .']);
    }
}
