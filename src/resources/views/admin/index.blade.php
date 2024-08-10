<!-- resources/views/admin/index.blade.php -->
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common-auth.css') }}">
@endsection

@section('content')
<div class="dashboard">
    <h1>管理者ダッシュボード</h1>
    <ul>
        <li><a href="{{ route('admin.representative.create') }}">店舗代表者を作成</a></li>
        <li><a href="{{ route('admin.representative.list') }}">店舗代表者一覧</a></li>
    </ul>
@endsection
