<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Review;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Mail\ReservationQRCodeMail;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function create(ReservationRequest $request)
    {
        $validated = $request->validated();
        $validated['restaurant_id'] = $request->input('restaurant_id');

        Reservation::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $validated['restaurant_id'],
            'reservation_date' => $validated['reservation_date'],
            'reservation_time' => $validated['reservation_time'],
            'number_of_people' => $validated['number_of_people'],
        ]);

        return redirect()->route('done')->with('message', '予約が完了しました');
    }

    public function done()
    {
        return view('done');
    }

    public function cancel($id)
    {
        $reservation = Reservation::where('user_id', Auth::id())
                                ->where('id', $id)
                                ->firstOrFail();
        $reservation->delete();

        return redirect()->route('mypage')->with('message', '予約をキャンセルしました');
    }

    public function edit($id)
    {
        $reservation = Reservation::where('user_id', Auth::id())
                                    ->where('id', $id)
                                    ->firstOrFail();

        return view('reservations.edit', compact('reservation'));
    }

    public function update(ReservationRequest $request, $id)
    {

        $validated = $request->validated();

        $reservation = Reservation::where('user_id', Auth::id())
                                    ->where('id', $id)
                                    ->firstOrFail();

        if (empty($validated['reservation_time'])) {
            $validated['reservation_time'] = $reservation->reservation_time;
        }

        $reservation->update([
            'reservation_date' => $validated['reservation_date'],
            'reservation_time' => $validated['reservation_time'],
            'number_of_people' => $validated['number_of_people'],
            'restaurant_id' => $request->input('restaurant_id'),
        ]);

        return redirect()->route('mypage')->with('message', '予約を変更しました');
    }

    public function confirmReservation($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);

        Mail::to($reservation->user->email)->send(new ReservationQRCodeMail($reservation));
    }

    public function storeReview(Request $request,$reservationId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Review::updateOrCreate(
            ['reservation_id' => $reservationId],
            ['rating' => $request->input('rating'),'comment' => $request->input('comment')]
        );

        return redirect()->route('mypage')->with('message','レビューが投稿されました');
    }

    public function mypage()
    {
        $reservations = Reservation::where('user_id',Auth::id())
                                    ->where(function ($query) {
                                        $query->whereDate('reservation_date','>=',now()->toDatestring())
                                        ->orWhereDoesntHave('review');
                                    })
                                    ->get();

        return view('mypage',compact('reservations'));
    }

    public function destroy($id)
    {
        $reservation = Reservation::where('user_id',Auth::id())
                                    ->where('id',$id)
                                    ->firstOrFail();

        $reservation->update(['is_closed' => true]);

        return redirect()->route('mypage');
    }
}
