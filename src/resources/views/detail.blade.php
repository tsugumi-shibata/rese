@extends('layouts.app')

@section('content')
    <h1>{{ $restaurant->name }}</h1>
    <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }}">
    <p>{{ $restaurant->description }}</p>
@endsection