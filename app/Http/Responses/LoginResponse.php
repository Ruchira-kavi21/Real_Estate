<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();
        $role = $user->role ?? 'unknown';

        if ($role === 'admin') {
            return redirect()->route('admin');
        } elseif ($role === 'seller') {
            return redirect()->route('sell');
        } elseif ($role === 'customer') {
            return redirect()->route('profile');
        }

        return redirect()->intended('/home');
    }
}