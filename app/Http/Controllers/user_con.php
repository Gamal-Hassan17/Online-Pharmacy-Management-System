<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class user_con extends Controller
{
    public function create_user()
    {
        return view('users.create_user');
    }

    public function store_user(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,cashier,customer',
        ]);

        User::create([
            'username' => $validated['username'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

        return redirect()->route('show_user')->with('success', 'User created successfully!');
    }

    public function show_user()
    {
        $show_users = User::all();
        return view('users.show_user', compact('show_users'));
    }

    public function edit_user($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit_user', compact('user'));
    }

    public function update_user(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
            'role'     => 'required|in:admin,cashier,customer',
        ]);

        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('show_user')->with('success', 'User updated successfully!');
    }

    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('show_user')->with('success', 'User deleted successfully!');
    }
}
