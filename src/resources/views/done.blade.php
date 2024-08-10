@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common-auth.css') }}">

@section('content')
    <div class="auth-container">
        <div class="thanks-message">
            ご予約ありがとうございます
        </div>
        <form class="auth-form" action="{{ route('home') }}">
            <button class="link-button" type="submit">
                戻る
            </button>
        </form>
    </div>

@endsection