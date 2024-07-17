<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Reservation;

class UserController extends Controller
{
    public function index()
    {
        // ユーザーのお気に入り店舗や予約状況の取得ロジック
        // ...
        $favorites = Favorite::where('user_id', Auth::id())->with('restaurant')->get();
        $reservations = Reservation::where('user_id', Auth::id())->with('restaurant')->get();

        return view('mypage',compact('favorites','reservations'));
    }

    public function thanks()
    {
        return view('thanks');
    }
}
