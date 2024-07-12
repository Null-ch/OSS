<?php

namespace App\Infrastructure\Factories\Resources\Messages;

use App\Infrastructure\Interfaces\MessageInterface;


class FailureMessage implements MessageInterface
{    
    /**
     * getMessage
     *
     * @return string
     */
    public function getMessage(): string
    {
        return 'Операция не удалась!';
    }
}
