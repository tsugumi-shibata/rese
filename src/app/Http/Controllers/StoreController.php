<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotificationMail;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Area;
use App\Models\Genre;

class StoreController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $restaurants = $user->restaurants;

        return view('store.index',compact('restaurants'));
    }

    public function edit($id)
    {
        $restaurant = Restaurant::findOrFail($id);

        $areas = Area::all();
        $genres = Genre::all();

        return view('store.edit',compact('restaurant','areas','genres'));
    }

    public function update(Request $request,$id)
    {
        $restaurant = Restaurant::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        $restaurant->update($validated);

        return redirect()->route('home',$restaurant->id)->with('message','店舗情報が更新されました');
    }

    public function reservations()
    {
        $user = Auth::user();
        $restaurants = $user->restaurants;
        $restaurantIds = $restaurants->pluck('id');

        $reservations = Reservation::whereIn('restaurant_id',$restaurantIds)->get();

        return view('store.reservations',compact('reservations'));
    }

    public function reservationDetail($id)
    {
        $reservation = Reservation::findOrFail($id);

        return view('store.reservation-detail',compact('reservation'));
    }

    public function sendNotification(Request $request,$userId)
    {
        $user = User::findOrFail($userId);
        $notificationMessage = $request->input('message');
        $reservation = Reservation::where('user_id',$userId)
                                    ->where('restaurant_id',Auth::user()->restaurants->first()->id)
                                    ->firstOrFail();

        Mail::to($user->email)->send(new UserNotificationMail($user,$notificationMessage,$reservation));

        return redirect()->back()->with('success','メールが送信されました');
    }

        public function show($id)
    {
        $restaurant = Restaurant::with('reviews')->findOrFail($id);

        return view('restaurants.show', compact('restaurant'));
    }
}
