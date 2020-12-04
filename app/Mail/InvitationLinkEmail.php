<?php


namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationLinkEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $hash;

    public function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    public function build()
    {
        return $this->view( 'Mail.verification', [
            'hash' => $this->hash
        ]);
    }
}
