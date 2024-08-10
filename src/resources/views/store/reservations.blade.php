@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common-auth.css') }}">
@endsection

@section('content')
<div class="dashboard">
    <h1>予約一覧</h1>

    @if($reservations->isEmpty())
        <p>予約がありません。</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>予約ID</th>
                    <!-- <th>店舗名</th> -->
                    <th>予約日</th>
                    <th>予約時間</th>
                    <th>人数</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <!-- <td>{{ $reservation->restaurant->name }}</td> -->
                        <td>{{ $reservation->reservation_date }}</td>
                        <td>{{ $reservation->reservation_time }}</td>
                        <td>{{ $reservation->number_of_people }}</td>
                        <td><a href="{{ route('store.reservation-detail', $reservation->id) }}">詳細</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
