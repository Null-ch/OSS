<?php

namespace App\Infrastructure\Interfaces;

interface MessageInterface
{
    /**
     * Method getMessage
     *
     * @param string $message
     *
     * @return string
     */
    public function getMessage(string $message): string;
}
