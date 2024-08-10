@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common-auth.css') }}">
@endsection

@section('content')
<div class="dashboard">
    <h2>店舗情報編集</h2>

    <form action="{{ route('store.update', $restaurant->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">店舗名:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $restaurant->name) }}" required>
        </div>

        <div>
            <label for="area_id">エリア:</label>
            <select id="area_id" name="area_id" required>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}" {{ $restaurant->area_id == $area->id ? 'selected' : '' }}>
                        {{ $area->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="genre_id">ジャンル:</label>
            <select id="genre_id" name="genre_id" required>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ $restaurant->genre_id == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="description">説明:</label>
            <textarea id="description" name="description">{{ old('description', $restaurant->description) }}</textarea>
        </div>

        <div>
            <label for="image_url">画像URL:</label>
            <input type="url" id="image_url" name="image_url" value="{{ old('image_url', $restaurant->image_url) }}">
        </div>

        <button type="submit">更新する</button>
    </form>

    <a href="{{ route('store.index') }}">戻る</a>
</div>
@endsection
