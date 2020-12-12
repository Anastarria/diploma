<?php


namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetLink extends Mailable
{
    use Queueable, SerializesModels;

    private $hash;

    public function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    public function build()
    {
        return $this->view( 'Mail.password_reset', [
            'hash' => $this->hash
        ]);
    }
}
