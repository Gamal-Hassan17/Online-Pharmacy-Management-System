<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class login_con extends Controller
{
    public function login() {
        return view('login');
    }

   public function do_login(Request $request) {
    // Validate input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);

    $credentials = $request->only('email', 'password');

    // تسجيل دخول admin أو cashier من جدول users
    if (Auth::guard('web')->attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::guard('web')->user();

        if ($user->role === 'admin') {
            return redirect()->route('dashboard')->with('success', 'Welcome Admin!');
        } elseif ($user->role === 'cashier') {
            return redirect()->route('index')->with('success', 'Welcome Cashier!');
        }
        elseif ($user->role === 'customer') {
            return redirect()->route('home')->with('success', 'Welcome Cashier!');
        }
        else {
            Auth::guard('web')->logout();
            return redirect()->route('login')->withErrors(['email' => 'Unauthorized role.']);
        }
    }

    // تسجيل دخول العميل من جدول customers


    return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
}


}
