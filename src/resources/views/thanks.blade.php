@extends('layouts.app')

@section('content')
    <h1>会員登録ありがとうございます</h1>
    <form action="{{ route('login') }}">
        <button type="submit">ログインする</button>
    </form>
    
@endsection