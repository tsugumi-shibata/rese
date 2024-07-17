@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

    @if (session('message'))
    <div class="alert-success">
        {{session('message')}}
    </div>
    @endif

    <div class="search-filter">
        <form action="{{ route('home') }}" method="get">
            <select name="area">
                <option value="">All Area</option>
                @foreach($areas as $area)
                <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </select>

            <select name="genre">
                <option value="">All Genre</option>
                @foreach($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>

            <input type="text" name="name">

            <button type="submit">search</button>
        </form>
    </div>

    <div class="restaurant-list">
        @foreach($restaurants as $restaurant)
        <div class="card">
            <img src="{{ $restaurant->image_url }}" alt="Restaurant Image">
            <div class="card-content">
                <h2>{{ $restaurant->name }}</h2>
                <p>#{{ $restaurant->area->name }} #{{ $restaurant->genre->name }}</p>
                <div class="card-buttons">
                    <a href="{{ route('detail', ['restaurant_id' => $restaurant->id]) }}" class="detail-button">詳しくみる</a>
                    @auth
                    <form action="{{ route('favorite.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                        <button type="submit" class="favorite-button">❤️</button>
                    </form>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>

@endsection