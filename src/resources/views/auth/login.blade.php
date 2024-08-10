@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common-auth.css') }}">

@section('content')
    <div class="auth-container">
        <div class="auth-title">Login</div>
        <form class="auth-form" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="input-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" placeholder="Email" value = "{{ old('email') }}">
                </div>
                <div class="error">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Password" value = "{{ old('password') }}">
                </div>
                <div class="error">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>

            </div>
            <button class="auth-button" type="submit">ログイン</button>
        </form>
    </div>

@endsection

