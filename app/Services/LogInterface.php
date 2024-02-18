<?php

namespace App\Services;

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
