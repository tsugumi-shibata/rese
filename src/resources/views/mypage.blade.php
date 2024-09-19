@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="dashboard-container">
    <div class="reservations-section">
        @if(session('message'))
            <div class="alert-success">
                {{ session('message') }}
            </div>
        @endif

        <h2>予約状況</h2>
        <ul>
            @forelse($reservations as $reservation)
            <div class="reservation-card">
                <form action="{{ route('reservation.cancel', $reservation->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="close-button">&times;</button>
                </form>

                <p>Shop {{ $reservation->restaurant->name }}</p>
                <p>Date {{ $reservation->reservation_date }}</p>
                <p>Time {{ $reservation->reservation_time }}</p>
                <p>Number {{ $reservation->number_of_people }}人</p>

                @if($reservation->isPast())
                    @if($reservation->isReviewed())
                        <p>評価済み: ★{{ $reservation->review->rating }} </p>
                        <p>{{ $reservation->review->comment }}</p>
                    @else
                        <form action="{{ route('review.store', $reservation->id) }}" method="post">
                            @csrf
                            <div>
                                <label for="rating">評価:</label>
                                <select name="rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">★{{ $i }} </option>
                                    @endfor
                                </select>
                            </div>

                            <div>
                                <label for="comment">コメント:</label>
                                <textarea name="comment"></textarea>
                            </div>

                            <button type="submit">レビューを投稿する</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('reservation.edit', $reservation->id) }}" class="edit-button">予約変更</a>
                @endif
            </div>

            @empty
            <div>予約がありません</div>
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
            <div>お気に入りがありません</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
