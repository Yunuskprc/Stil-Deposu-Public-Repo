<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailVerificationCode;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailVerificationCode,$user)
    {
        $this->emailVerificationCode = $emailVerificationCode;
        $this->user = $user;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('koprucu2323@hotmail.com')
                    ->subject('E-posta Doğrulama Kodu')
                    ->view('emails.verify')
                    ->with([
                        'emailVerificationCode' => $this->emailVerificationCode,
                        'user' => $this->user
                    ]);
    }
}