<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ActivateUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build(User $user)
    {
        $mailFrom = env('MAIL_FROM_ADDRESS');
        $mailFromName = env('APP_NAME');
        return $this->from($mailFrom,$mailFromName)
                    ->subject("Activación de cuenta en Expedientes")
                    ->view('mail.activate-user')
                    ->with([
                        'user' => $user,
                    ]);
    }
}
