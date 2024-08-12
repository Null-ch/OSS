<?php

namespace App\Infrastructure\Factories;


use App\Infrastructure\Interfaces\MessageInterface;
use App\Infrastructure\Factories\Resources\Messages\ErrorMessage;
use App\Infrastructure\Factories\Resources\Messages\FailureMessage;
use App\Infrastructure\Factories\Resources\Messages\SuccessMessage;
use App\Infrastructure\Factories\Resources\Messages\WarningMessage;

class MessageFactory
{    
    /**
     * create
     *
     * @param  string $type
     * @return MessageInterface
     */
    public static function create(string $type): MessageInterface
    {
        switch ($type) {
            case 'success':
                return new SuccessMessage();
            case 'failure':
                return new FailureMessage();
            case 'warning':
                return new WarningMessage();
            case 'error':
                return new ErrorMessage();
            default:
                throw new \InvalidArgumentException("Неизвестный тип сообщения: $type");
        }
    }
}
