<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
{
    if (Auth::check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }
    return view('auth.login');
}

    protected function redirectTo()
{
    if (auth()->user()->role === 'admin') {
        return '/admin/dashboard';
    }
    return '/'; // diğer rollerin yönlendirmesi
}

    public function login(Request $request)
    {
          $request->validate([
        'email' => 'required|email',
        'password' => 'required',

    ]);

    $credentials = $request->only('email', 'password');
    $remember = $request->has('remember');
    

    if (Auth::attempt($credentials, $remember)) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }

    return back()->withErrors(['email' => 'Geçersiz bilgiler'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
