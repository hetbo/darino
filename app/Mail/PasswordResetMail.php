<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public string $token
    ) {}

    public function build()
    {
        $resetUrl = url("/reset-password/{$this->token}?email={$this->user->email}");

        return $this->subject(__('Reset Password'))
            ->view('emails.password-reset')
            ->with([
                'user' => $this->user,
                'resetUrl' => $resetUrl,
            ]);
    }
}
