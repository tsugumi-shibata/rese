<!-- resources/views/register.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>会員登録ページ</h1>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value = "{{ old('name') }}">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value = "{{ old('email') }}">
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value = "{{ old('password') }}">
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Register</button>
    </form>
@endsection
