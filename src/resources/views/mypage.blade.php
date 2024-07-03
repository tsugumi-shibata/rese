<!-- resources/views/mypage.blade.php -->
@extends('layouts.app')

@section('content')
    @if(session('message'))
        <div class="alert-success">
            {{ session('message') }}
        </div>
    @endif
    
    <h1>マイページ</h1>
    <!-- お気に入り店舗や予約状況の表示 -->
    <h2>お気に入り店舗</h2>
    <!-- お気に入り店舗リスト -->

    <h2>予約状況</h2>
    <!-- 予約状況リスト -->
@endsection