<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function verify(EmailVerificationRequest $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return Redirect::route('home')->with('message','メールアドレスはすでに確認済みです');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return Redirect::route('home')->with('message','メールアドレスの確認が完了しました');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return Redirect::route('verification.notice')->with('message','確認メールを再送信しました');
    }
}
