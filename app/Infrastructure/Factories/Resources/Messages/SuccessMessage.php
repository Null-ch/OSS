<?php

namespace App\Infrastructure\Factories\Resources;

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
