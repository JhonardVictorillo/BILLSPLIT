<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $resetLink;
    /**
     * Create a new message instance.
     */
    public function __construct($resetLink)
    {
        $this->resetLink = $resetLink;
    }

    /**
     * * Build the message.
     */
    public function build()
    {
        return $this->subject('Password Reset Request')
                    ->view('emails.passwordresetEmail') // View for the email
                    ->with(['resetLink' => $this->resetLink]);
    }
}
