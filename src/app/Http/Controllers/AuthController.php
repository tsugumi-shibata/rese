<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole('user');

        return redirect()->route('thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->route('admin.index')->with('message','ログインしました');
            }

            if($user->hasRole('store_representative')) {
                return redirect()->route('store.index')->with('message','ログインしました');
            }

            return redirect()->route('mypage')->with('message', 'ログインしました');
        }

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        session()->flash('message','ログアウトしました');

        return redirect()->route('home');
    }
}
