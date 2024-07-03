<!-- resources/views/login.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>ログインページ</h1>
    <!-- ログインフォーム -->
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <!-- フォームフィールド -->
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
@endsection