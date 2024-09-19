<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AfterNow;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'reservation_date' => 'required|date|after:today',
            'reservation_time' =>'required',
            'number_of_people' => 'required|integer|min:1',
        ];

        // 予約変更
        if ($this->isMethod('put') || $this->isMethod('patch')){
            $reservation = $this->route('reservation');

            if ($reservation) {
                $rules['reservation_date'] .'|after_or_equal:' .$reservation->reservation_date;
            }
            $rules['reservation_time'] = 'nullable';
        }

        return $rules;

    }

    public function messages()
    {
        return [
            'reservation_date.required' => '日付を選択してください',
            'reservation_date.after' => '今日より後の日付を選択してください',
            'reservation_date.after_or_equal' => '予約日は変更前の日付以降を選択してください',
            'reservation_time.required' => '時間を選択してください',
            'number_of_people.required' => '人数を選択してください',
            'number_of_people.min' => '1人以上を選択してください',
        ];
    }
}
