<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FAQRCode\Google2FA;

class TwoFactorController extends Controller
{
    public function setup()
    {
        $user = Auth::user();

        $google2fa = new Google2FA();

        if (!$user->google2fa_secret) {
            $user->google2fa_secret = $google2fa->generateSecretKey();
            $user->save();
        }

        $qrCodeUrl = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );

        return view('auth.two-factor-setup', compact('user', 'qrCodeUrl'));
    }

    public function enable(Request $request)
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ], [
            'code.required' => 'Vui lòng nhập mã xác thực.',
            'code.digits' => 'Mã xác thực phải gồm 6 số.',
        ]);

        $user = Auth::user();

        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey(
            $user->google2fa_secret,
            $request->code
        );

        if (!$valid) {
            return back()->withErrors([
                'code' => 'Mã xác thực không đúng.',
            ]);
        }

        $user->update([
            'google2fa_enabled_at' => now(),
        ]);

        session(['2fa_passed' => true]);

        return redirect()
            ->route('admin.index')
            ->with('success', 'Đã bật xác thực 2 lớp thành công.');
    }

    public function disable(Request $request)
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $user = Auth::user();

        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey(
            $user->google2fa_secret,
            $request->code
        );

        if (!$valid) {
            return back()->withErrors([
                'code' => 'Mã xác thực không đúng.',
            ]);
        }

        $user->update([
            'google2fa_secret' => null,
            'google2fa_enabled_at' => null,
        ]);

        session()->forget('2fa_passed');

        return redirect()
            ->route('admin.index')
            ->with('success', 'Đã tắt xác thực 2 lớp.');
    }

    public function challenge()
    {
        return view('auth.two-factor-challenge');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ], [
            'code.required' => 'Vui lòng nhập mã xác thực.',
            'code.digits' => 'Mã xác thực phải gồm 6 số.',
        ]);

        $user = Auth::user();

        if (!$user || !$user->hasTwoFactorEnabled()) {
            return redirect()->route('login');
        }

        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey(
            $user->google2fa_secret,
            $request->code
        );

        if (!$valid) {
            return back()->withErrors([
                'code' => 'Mã xác thực không đúng.',
            ]);
        }

        session(['2fa_passed' => true]);

        return redirect()->intended(route('admin.index'));
    }
}
