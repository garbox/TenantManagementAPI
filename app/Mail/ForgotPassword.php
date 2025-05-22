<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public string $resetLink;
    public $user;

    public function __construct(string $resetLink, User $user)
    {
        $this->resetLink = $resetLink;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Reset Your Password')
                    ->view('auth.forgot-password')
                    ->with([
                        'resetLink' => $this->resetLink,
                        'user' => $this->user,
                    ]);
    }
}
