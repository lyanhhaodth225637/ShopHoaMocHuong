<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureCurrentSessionMatches
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return $next($request);
        }

        $currentSessionId = $request->session()->getId();

        if ($user->current_session_id && $user->current_session_id !== $currentSessionId) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with('warning', 'Tai khoan da dang nhap tren thiet bi khac. Vui long dang nhap lai.');
        }

        return $next($request);
    }
}
