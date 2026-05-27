<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('tablar::auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $request->session()->forget('2fa_passed');

        $user = $request->user();

        if ($user) {
            $user->forceFill([
                'current_session_id' => $request->session()->getId(),
            ])->save();
        }

        if ($user && $user->hasRole('super-admin')) {
            if (!$user->hasTwoFactorEnabled()) {
                return redirect()->route('admin.2fa.setup');
            }

            return redirect()->route('admin.2fa.challenge');
        }

        return redirect()->intended(route('home', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();
        $currentSessionId = $request->session()->getId();

        if ($user && $user->current_session_id === $currentSessionId) {
            $user->forceFill([
                'current_session_id' => null,
            ])->save();
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
