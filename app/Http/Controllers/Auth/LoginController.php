<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            Session::put('user_id', $user->id);
            Session::put('user_email', $email);
            Session::put('logged_in', true);
            Session::put('role', $user->role); 

            if ($user->role === 'admin') {
                return redirect()->intended('/adminHome');
            }
            return redirect()->intended('/home');
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }
}