@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common-auth.css') }}">


@section('content')
    <div class="auth-container">
        <div class="thanks-message">
            会員登録ありがとうございます
        </div>
        <form class="auth-form" action="{{ route('login') }}">
            <button class="link-button" type="submit">
                ログインする
            </button>
        </form>
    </div>

@endsection