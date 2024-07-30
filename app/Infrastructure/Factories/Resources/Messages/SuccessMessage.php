<?php

namespace App\Infrastructure\Factories\Resources\Messages;

use App\Infrastructure\Interfaces\MessageInterface;

class SuccessMessage implements MessageInterface
{    
    /**
     * getMessage
     *
     * @return string
     */
    public function getMessage(): string
    {
        return 'Операция выполнена успешно!';
    }
}
