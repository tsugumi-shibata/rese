@extends('layouts.app')

@section('content')
    <h1>予約編集</h1>

    <form action="{{ route('reservation.update', $reservation->id) }}" method="post">
        @csrf
        @method('PUT')

        <input type="hidden" name="restaurant_id" value="{{ $reservation->restaurant_id }}">
        
        <div>
            <label for="reservation_date">予約日:</label>
            <input type="date" name="reservation_date" value="{{ $reservation->reservation_date }}">
        </div>
        
        <div>
            <label for="reservation_time">予約時間:</label>
            <input type="time" name="reservation_time" value="{{ $reservation->reservation_time }}">
        </div>
        
        <div>
            <label for="number_of_people">人数:</label>
            <select name="number_of_people">
                <option value="1" @if($reservation->number_of_people == 1) selected @endif>1人</option>
                <option value="2" @if($reservation->number_of_people == 2) selected @endif>2人</option>
                <option value="3" @if($reservation->number_of_people == 3) selected @endif>3人</option>
                <option value="4" @if($reservation->number_of_people == 4) selected @endif>4人</option>
                <option value="5" @if($reservation->number_of_people == 5) selected @endif>5人</option>
            </select>
        </div>

        <button type="submit">更新する</button>
    </form>
@endsection
