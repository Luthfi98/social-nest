<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        $data = [
            'title' => __('Login'),  
        ];
        return view('auth.login')->with($data);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check if login input is email or username
        $login_type = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        // Attempt to authenticate
        if (Auth::attempt([$login_type => $credentials['login'], 'password' => $credentials['password']])) {
            if (Auth::user()->status !== 'active') {
                throw ValidationException::withMessages([
                    'login' => [trans('auth.account_inactive')],
                ]);
            }

            $request->session()->regenerate();
            $request->session()->put('user_id', Auth::user()->id);
            return redirect()->intended('/');
        }

        throw ValidationException::withMessages([
            'login' => [trans('auth.failed')],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
