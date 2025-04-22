<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $name;
    public $newPassword;

    public function __construct($name, $newPassword)
    {
        $this->name = $name;
        $this->newPassword = $newPassword;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject('Password _ Hasu no Haru ')
                    ->view('auth.reset-password')
                    ->with([
                        'name' => $this->name,
                        'newPassword' => $this->newPassword,
                    ]);
    }
}
