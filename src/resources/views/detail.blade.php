@extends('layouts.app')

@section('content')
    <h1>{{ $restaurant->name }}</h1>
    <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }}">
    <p>{{ $restaurant->description }}</p>

    @auth
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
    @endauth
@endsection
