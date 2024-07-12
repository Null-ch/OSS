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
    public function getMessage(): string
    {
        return 'Что-то пошло не так!';
    }
}
