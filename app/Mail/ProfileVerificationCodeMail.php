<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProfileVerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $code;
    public string $expiresAt;

    public function __construct(User $user, string $code, string $expiresAt)
    {
        $this->user = $user;
        $this->code = $code;
        $this->expiresAt = $expiresAt;
    }

    public function build()
    {
        return $this->subject('Código de verificación de perfil')
            ->theme('ocean')
            ->markdown('emails.verification_code', [
                'user' => $this->user,
                'code' => $this->code,
                'expiresAt' => $this->expiresAt,
            ]);
    }
}
