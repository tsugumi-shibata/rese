<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserController extends Controller
{
    public function mypage()
    {
        // ユーザーのお気に入り店舗や予約状況の取得ロジック
        // ...

        return view('mypage');
    }

    public function thanks()
    {
        return view('thanks');
    }
}
