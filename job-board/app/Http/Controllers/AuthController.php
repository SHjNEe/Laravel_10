<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct(private AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function create()
    {
        return view('auth.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $remember = $request->filled('remember');
        if ($this->authService->attemptLogin($request->email, $request->password, $remember)) {
            return redirect()->intended('/');
        } else {
            return redirect()->back()
                ->with('message', 'Invalid credentials')
                ->with('status', 'error')
                ->withInput($request->except('password'))
                ->withErrors(['password' => 'Password is valid'])
                ->with('status', 'error');
        }
    }

    public function destroy()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     $credentials = $request->only('email', 'password');
    //     $remember = $request->filled('remember');

    //     if (Auth::attempt($credentials, $remember)) {
    //         return redirect()->intended('/');
    //     } else {
    //         return redirect()->back()
    //             ->with('error', 'Invalid credentials');
    //     }
    // }


}
