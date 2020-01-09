<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $pin_code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pin_code)
    {
        $this->pin_code = $pin_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.resetpassword')->with([
            'pincode' => $this->pin_code
        ]);
    }
}
