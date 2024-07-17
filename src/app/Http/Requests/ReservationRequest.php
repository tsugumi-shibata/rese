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
        return [
            'reservation_date' => 'required|date|after:today',
            'reservation_time' => ['required', 'date_format:H:i', new AfterNow()],
            'number_of_people' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '日付を選択してください',
            'reservation_date.after' => '今日より後の日付を選択してください',
            'reservation_time.required' => '時間を選択してください',
            'reservation_time.date_format' => '時間は「HH:MM」形式で入力してください',
            'number_of_people.required' => '人数を選択してください',
            'number_of_people.min' => '1人以上を選択してください',
        ];
    }
}
