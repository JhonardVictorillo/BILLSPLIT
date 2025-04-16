<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verificationUrl;
    public $loginUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->verificationUrl = route('verify.email', ['token' => $user->email_verification_token]);
        $this->loginUrl = route('login.form');
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Welcome to BillSplit Pro - Verify Your Email')
                    ->view('emails.welcomeEmail') // ✅ Corrected view path
                    ->with([
                        'user' => $this->user,
                        'verificationUrl' => $this->verificationUrl,
                        'loginUrl' => $this->loginUrl,
                    ]);
    }
}
