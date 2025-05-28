<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->is('login', 'register', 'logout') && auth()->check()) {
            $user = auth()->user();
            $role = $user->role ?? 'unknown';
            Log::info('RedirectBasedOnRole Middleware Triggered', [
                'user_id' => $user->id,
                'role' => $role,
                'current_path' => $request->path(),
            ]);

            if ($role === 'admin' && $request->path() !== 'Admin/dashboard') {
                Log::info('Redirecting admin to Admin/dashboard');
                return redirect()->route('admin');
            } elseif ($role === 'seller' && $request->path() !== 'sell') {
                Log::info('Redirecting seller to sell');
                return redirect()->route('sell');
            } elseif ($role === 'customer' && $request->path() !== 'profile') {
                Log::info('Redirecting customer to profile');
                return redirect()->route('profile');
            }
        }

        return $next($request);
    }
}