<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfterRegisterMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Вы успешно зарегистрировались!';

        return $this->from('info@inamr.ru')
            ->subject($subject)
            ->view('email.afterRegister', [
                'user' => $this->user,
            ]);
    }
}
