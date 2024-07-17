<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class AfterNow implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $reservationDate = request()->input('reservation_date');
        $reservationTime = $value;
        $reservationDateTime = Carbon::parse("$reservationDate $reservationTime");

        return $reservationDateTime->isAfter(now());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '現在時刻より前は選択できません';
    }
}
