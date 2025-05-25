<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisteredUserController extends Controller
{
    public function showRegistrationForm()
    {
        if (Session::has('logged_in') && Session::get('logged_in')) {
            $role = Session::get('role');
            if ($role === 'admin') {
                return redirect()->route('adminHome');
            } elseif ($role === 'seller') {
                return redirect()->route('sellerHome'); // Define this route later if needed
            }
            return redirect()->route('index');
        }
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:customer,seller,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('login')->with('status', 'User registered successfully.');
    }
}