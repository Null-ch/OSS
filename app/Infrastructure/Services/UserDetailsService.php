<?php

namespace App\Infrastructure\Services;

use App\Models\UserDetails;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;

class UserDetailsService
{
    protected $userDetails;
    protected $logger;
    protected $messageService;
    public function __construct(UserDetails $userDetails, LogInterface $logger, MessageService $messageService)
    {
        (object) $this->userDetails = $userDetails;
        (object) $this->logger = $logger;
        (object) $this->messageService = $messageService;
    }
}
