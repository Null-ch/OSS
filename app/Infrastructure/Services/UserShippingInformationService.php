<?php

namespace App\Infrastructure\Services;

use App\Models\UserShippingInformation;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;

class UserShippingInformationService
{
    protected $userShippingInformation;
    protected $logger;
    protected $messageService;
    public function __construct(UserShippingInformation $userShippingInformation, LogInterface $logger, MessageService $messageService)
    {
        (object) $this->userShippingInformation = $userShippingInformation;
        (object) $this->logger = $logger;
        (object) $this->messageService = $messageService;
    }
}
