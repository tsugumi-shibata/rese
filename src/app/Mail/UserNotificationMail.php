<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIo\QrCode\Facades\QrCode;

class UserNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $notificationMessage;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$notificationMessage,$reservation)
    {
        $this->user = $user;
        $this->notificationMessage = $notificationMessage;
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $reservationUrl = route('store.reservation-detail',['id' => $this->reservation->id]);

        $qrCodeImage = QrCode::format('png')->size(200)->generate($reservationUrl);

        return $this->subject('店舗からの通知')
                    ->view('emails.user_notification')
                    ->attachData($qrCodeImage,'reservation_qrcode.png',['mime' => 'image/png'])
                    ->withSwiftMessage(function ($message) {
                        $message->embedData($qrCodeImage,'reservation_qrcode.png','image/png');
                    });
    }
}
