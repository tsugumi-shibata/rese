<!-- resources/views/admin/representative/list.blade.php -->
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common-auth.css') }}">
@endsection

@section('content')
<div class="admin-dashboard">
    <h1>店舗代表者一覧</h1>
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ユーザー名</th>
                <th>メールアドレス</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($representatives as $representative)
                <tr>
                    <td>{{ $representative->name }}</td>
                    <td>{{ $representative->email }}</td>
                    <td>
                        <form action="{{ route('admin.representative.destroy', $representative->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
