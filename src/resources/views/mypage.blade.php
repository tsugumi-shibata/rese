@extends('layouts.app')

@section('content')
    @if(session('message'))
        <div class="alert-success">
            {{ session('message') }}
        </div>
    @endif

    <h1>マイページ</h1>

    <h2>予約状況</h2>
        <ul>
            @forelse($reservations as $reservation)
            <li>Shop {{ $reservation->restaurant->name }}</li>
            <li>Date {{ $reservation->reservation_date }}</li>
            <li>Time {{ $reservation->reservation_time }}</li>
            <li>Number {{ $reservation->number_of_people }}人</li>
            <li>
                <form action="{{ route('reservation.delete', $reservation->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">キャンセル</button>
                </form>
                <a href="{{ route('reservation.edit', $reservation->id) }}" class="edit-button">変更</a>
            </li>
            @empty
            <li>予約がありません</li>
            @endforelse
        </ul>

    <h2>お気に入り店舗</h2>
        <ul>
            @forelse($favorites as $favorite)
            <li>
                {{ $favorite->restaurant->name }}
                <form action="{{ route('favorite.delete', $favorite->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">削除</button>
                </form>
            </li>
            @empty
            <li>お気に入りがありません</li>
            @endforelse
        </ul>
@endsection
