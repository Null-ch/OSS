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
    public function getMessage($message = null): string
    {
        return $message ? $message : 'Операция выполнена успешно!';
    }
}
