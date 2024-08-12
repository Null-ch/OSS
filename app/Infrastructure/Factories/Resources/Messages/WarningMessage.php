<?php

namespace App\Infrastructure\Factories\Resources\Messages;

use App\Infrastructure\Interfaces\MessageInterface;

class WarningMessage implements MessageInterface
{    
    /**
     * getMessage
     *
     * @return string
     */
    public function getMessage($message = null): string
    {
        return $message ? $message : 'Что-то пошло не так!';
    }
}
