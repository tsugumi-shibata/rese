@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common-auth.css') }}">
@endsection

@section('content')
<div class="dashboard">
    <h1>予約詳細</h1>

    <div class="reservation-detail">
        <p>予約ID: {{ $reservation->id }}</p>
        <p>ユーザー名: {{ $reservation->user->name }}</p>
        <p>予約日: {{ $reservation->reservation_date }}</p>
        <p>予約時間: {{ $reservation->reservation_time }}</p>
        <p>人数: {{ $reservation->number_of_people }}</p>
        <p>ユーザーEmail: {{ $reservation->user->email }}</p>
    </div>

    <a href="{{ route('store.reservations') }}">戻る</a>
</div>
@endsection
