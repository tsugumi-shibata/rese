<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function add(Request $request)
    {
        $favorite = new Favorite();
        $favorite->user_id = Auth::id();
        $favorite->restaurant_id = $request->restaurant_id;
        $favorite->save();

        return redirect()->back()->with('message','お気に入りに追加しました');
    }

    public function destroy($id)
    {
        Favorite::where('user_id',Auth::id())
                ->where('id', $id)
                ->delete();

        return redirect()->back()->with('message','お気に入りから削除しました');
    }
}
