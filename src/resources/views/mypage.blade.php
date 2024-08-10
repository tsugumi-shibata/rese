@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    @if(session('message'))
        <div class="alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="dashboard-container">
        <div class="reservations-section">
            <h2>予約状況</h2>
            <ul>
                @forelse($reservations as $reservation)
                <div class="reservation-card">
                    <p>Shop {{ $reservation->restaurant->name }}</p>
                    <p>Date {{ $reservation->reservation_date }}</p>
                    <p>Time {{ $reservation->reservation_time }}</p>
                    <p>Number {{ $reservation->number_of_people }}人</p>
                    <p>
                        <a href="{{ route('reservation.edit', $reservation->id) }}" class="edit-button">変更</a>
                    </p>
                </div>
                @empty
                <li>予約がありません</li>
                @endforelse
            </ul>
        </div>

        <div class="favorites-section">
            <h2>お気に入り店舗</h2>
            <div class="restaurant-list">
                @forelse($favorites as $favorite)
                <div class="card">
                    <img src="{{ $favorite->restaurant->image_url }}" alt="Restaurant Image">
                    <div class="card-content">
                        <h2>{{ $favorite->restaurant->name }}</h2>
                        <p>#{{ $favorite->restaurant->area->name }} #{{ $favorite->restaurant->genre->name }}</p>
                        <div class="card-buttons">
                            <a href="{{ route('detail', ['restaurant_id' => $favorite->restaurant->id]) }}" class="detail-button">詳しくみる</a>
                            <form action="{{ route('favorite.toggle') }}" method="post" class="favorite-form">
                                @csrf
                                <input type="hidden" name="restaurant_id" value="{{ $favorite->restaurant->id }}">
                                <button type="submit" class="favorite-button favorited">
                                    <span class="heart">&#9829;</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <li>お気に入りがありません</li>
                @endforelse
            </div>
        </div>
    </div>
@endsection
