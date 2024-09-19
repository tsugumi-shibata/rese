@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
    <div class="restaurant-container">
        <div class="restaurant-details">
            <div class="header">
                <a href="{{ url()->previous() }}" class="back-button"><</a>
            <h1 class="restaurant-name">{{ $restaurant->name }}</h1>
            </div>

            <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }}">
            <p>#{{ $restaurant->area->name }} #{{ $restaurant->genre->name }}</p>
            <div class="restaurant-description">
                <p>{{ $restaurant->description }}</p>

                <h2>レビュー</h2>
                @if($restaurant->reviews->isEmpty())
                    <p>まだレビューがありません</p>
                @else
                    @foreach($restaurant->reviews as $review)
                        <div class="review-card">
                            <p>評価: ★{{ $review->rating }} </p>
                            <p>コメント: {{ $review->comment }}</p>
                            <p>{{ $review->created_at->format('Y年m月d日') }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        @auth
        <div class="reservation-form-card">
            <h2>予約</h2>
            <form action="{{ route('reservation.create') }}" method="post">
                @csrf
                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

                <div>
                    <input type="date" name="reservation_date" value="{{ old('reservation_date') }}" onchange="this.form.date_display.value = this.value">
                    @error('reservation_date')
                        <div>{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <input type="time" name="reservation_time" value="{{ old('reservation_time') }}" onchange="this.form.time_display.value = this.value">
                    @error('reservation_time')
                        <div>{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <select name="number_of_people" onchange="this.form.number_display.value = this.value">
                        <option value="" {{ old('number_of_people') === null ? 'selected' : '' }}>-</option>
                        <option value="1" {{ old('number_of_people') == 1 ? 'selected' : '' }}>1人</option>
                        <option value="2" {{ old('number_of_people') == 2 ? 'selected' : '' }}>2人</option>
                        <option value="3" {{ old('number_of_people') == 3 ? 'selected' : '' }}>3人</option>
                        <option value="4" {{ old('number_of_people') == 4 ? 'selected' : '' }}>4人</option>
                        <option value="5" {{ old('number_of_people') == 5 ? 'selected' : '' }}>5人</option>
                    </select>
                    @error('number_of_people')
                        <div>{{ $message }}</div>
                    @enderror
                </div>

                <div class="confirm">
                    <p>Shop {{ $restaurant->name }}</p>
                    <p>Date <input type="text" name="date_display" readonly></p>
                    <p>Time <input type="text" name="time_display" readonly></p>
                    <p>Number <input type="text" name="number_display" readonly>人</p>
                </div>
                <button type="submit" class="reserve-button">予約する</button>
            </form>
        </div>


        @endauth
    </div>
@endsection
