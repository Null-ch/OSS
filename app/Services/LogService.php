<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class LogService implements LogInterface
{
    /**
     * Log class
     *
     * @var object
     */
    private $logger;
    /**
     * Construct logger
     *
     * @param Log $logger
     * 
     */
    public function __construct(Log $logger)
    {
        (object) $this->logger = $logger;
    }
    /**
     * Implementation of a method that allows logging errors
     *
     * @param string $message
     * 
     */
    public function error($message)
    {
        $this->logger::error($message);
    }
}
