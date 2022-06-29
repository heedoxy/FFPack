<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function username() {
        return 'phone';
    }

    public function login_show() {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $credentials = $request->only('phone', 'password');

        if (Auth::attempt($credentials)) {
            // if success login
            return redirect('/');
        }
        // if failed login
        return redirect('/login');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
