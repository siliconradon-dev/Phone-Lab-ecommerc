<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $user;
    public $url;

    public function __construct($user, $url)
    {
        $this->user = $user;
        $this->url = $url;
    }

    public function build()
    {
        return $this->subject('Verify Your Account')
            ->view('emails.verify-account')
            ->with([
                'name' => $this->user->name,
                'url' => $this->url,
            ]);
    }
}
