<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Hash;



class register extends Controller
{
    public function register()
    {
        return view('register');
    }

  public function do_register(Request $request)
{
    $validated = $request->validate([
        'username' => 'required|string|max:255|unique:users',
        'email'    => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'role'     => 'required|in:admin,cashier,customer',
    ]);

    user::create([
        'username' => $validated['username'],
        'email'    => $validated['email'],
        'role'     => $validated['role'],
        'password' => Hash::make($validated['password']),
    ]);

return redirect()->route('login')->with('success', 'تم التسجيل بنجاح. الرجاء تسجيل الدخول.');
}



}
