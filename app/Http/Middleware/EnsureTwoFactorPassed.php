<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorPassed
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (
            !$request->routeIs('admin.2fa.*')
            && !$request->routeIs('logout')
        ) {
            if (!$user->hasTwoFactorEnabled()) {
                return redirect()->route('admin.2fa.setup');
            }

            if (!session('2fa_passed')) {
                return redirect()->route('admin.2fa.challenge');
            }
        }

        return $next($request);
    }
}
