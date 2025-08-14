<?php

namespace App\Http\Controllers\admin\auth;
use PragmaRX\Google2FAQRCode\Google2FA;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Google2FAController extends Controller
{
    public function setup(Request $request)
    {
         $google2fa = new Google2FA();
        $user = Auth::user(1);

        // Generate a secret key for the user
        $user->google2fa_secret = $google2fa->generateSecretKey();
        $user->save();

        // Generate a QR code URL
        $QRImage = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );

        return view('2fa.setup', ['QRImage' => $QRImage, 'secret' => $user->google2fa_secret]);
    }

    public function store(Request $request)
    {
        $request->validate(['secret' => 'required|string']);

        $user = Auth::user();
        $user->google2fa_secret = $request->input('secret');
        $user->save();

        return redirect()->route('home')->with('success', '2FA is now enabled.');
    }

    public function verify()
    {
        return view('2fa.verify');
    }

    public function check(Request $request)
    {
        $request->validate(['one_time_password' => 'required|numeric']);

        $google2fa = new Google2FA();
        $user = Auth::user();
        $valid = $google2fa->verifyKey($user->google2fa_secret, $request->input('one_time_password'));

        if ($valid) {
            $request->session()->put('2fa_verified', true);
            return redirect()->route('home');
        }

        return redirect()->route('2fa.verify')->withErrors(['Invalid verification code, please try again.']);
    }
}
