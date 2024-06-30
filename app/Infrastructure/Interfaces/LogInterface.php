<?php

namespace App\Infrastructure\Interfaces;

interface LogInterface
{
    /**
     * A method for logging errors
     *
     * @param string $message
     * 
     * 
     */
    public function error($message);
}
