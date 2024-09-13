@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common-auth.css') }}">
@endsection

@section('content')
<form action="{{ route('send-notification') }}" method="POST">
    @csrf
    <label for="user_id">ユーザーを選択:</label>
    <select name="user_id" id="user_id">
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>

    <label for="message">メッセージ内容:</label>
    <textarea name="message" id="message" rows="4"></textarea>

    <button type="submit">送信</button>
</form>
@endsection