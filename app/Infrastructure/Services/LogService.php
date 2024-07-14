<?php

namespace App\Infrastructure\Services;

use Illuminate\Support\Facades\Log;
use App\Infrastructure\Interfaces\LogInterface;

class LogService implements LogInterface
{
    /**
     * Log class
     *
     * @var object
     */
    protected $logger;
    /**
     * Construct logger
     *
     * @param Log $logger
     * 
     */
    public function __construct(Log $logger)
    {
        $this->logger = $logger;
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
