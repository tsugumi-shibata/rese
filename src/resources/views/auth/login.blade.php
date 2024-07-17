@extends('layouts.app')

@section('content')
    <h1>ログインページ</h1>
    <form action="{{ route('login') }}" method="POST">
        @csrf
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
        <button type="submit">Login</button>
    </form>
@endsection