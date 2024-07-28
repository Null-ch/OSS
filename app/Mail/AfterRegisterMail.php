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
    protected $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(object $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Вы успешно зарегистрировались!';

        return $this->from('info@oss.ru')
            ->subject($subject)
            ->view('email.afterRegister', [
                'user' => $this->user,
                'password' => $this->password,
            ]);
    }
}
