<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();
            $role = $user->role;
            \Log::info('RedirectBasedOnRole Middleware Triggered', [
                'user_id' => $user->id,
                'role' => $role,
                'current_path' => $request->path(),
            ]);
            // dd($role); // Uncomment this to debug the role value

            if ($role === 'admin' && !$request->is('Admin/dashboard')) {
                return redirect()->route('admin');
            } elseif ($role === 'seller' && !$request->is('sell')) {
                return redirect()->route('sell');
            } elseif ($role === 'customer' && !$request->is('profile')) {
                return redirect()->route('profile');
            }
        }

        return $next($request);
    }
}