<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Support\Facades\Auth;
use App\Models\User;
use App\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function register(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // フラッシュメッセージを設定
            session()->flash('message', 'ログインしました');

            return redirect()->route('mypage');
        }

        return back()->withErrors([
            'email' => '認証に失敗しました',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        session()->flash('message','ログアウトしました');

        return redirect()->route('home');
    }
}
