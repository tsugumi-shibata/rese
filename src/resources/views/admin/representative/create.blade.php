<!-- resources/views/admin/create-store-representative.blade.php -->
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common-auth.css') }}">
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-title">店舗代表者作成</div>
    <form class="auth-form" action="{{ route('admin.representative.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <div class="input-icon">
                <i class="fas fa-user"></i>
                <input type="text" id="name" name="name" placeholder="Username" value="{{ old('name') }}">
            </div>
            <div class="error">
                @error('name')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="input-icon">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
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
                <input type="password" id="password" name="password" placeholder="Password">
            </div>
            <div class="error">
                @error('password')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <button class="auth-button" type="submit">作成</button>
    </form>
</div>
@endsection
