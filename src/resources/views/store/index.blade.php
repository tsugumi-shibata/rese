@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common-auth.css') }}">
@endsection

@section('content')
<div class="dashboard">
    @if($restaurants->isEmpty())
        <p>管理する店舗がありません。</p>
    @else

    @foreach($restaurants as $restaurant)
        <h2>{{ $restaurant->name }}</h2>
            <li>
                <a href="{{ route('store.edit', $restaurant->id) }}">店舗情報編集</a>
            </li>
            <li>
                <a href="{{ route('store.reservations') }}">予約一覧</a>
            </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
