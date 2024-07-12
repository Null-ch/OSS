<?php

namespace App\Infrastructure\Services;

use App\Models\OrderUserDetail;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;

class OrderUserDetailsService
{
    protected $orderUserDetail;
    protected $logger;
    protected $messageService;
    public function __construct(OrderUserDetail $orderUserDetail, LogInterface $logger, MessageService $messageService)
    {
        (object) $this->orderUserDetail = $orderUserDetail;
        (object) $this->logger = $logger;
        (object) $this->messageService = $messageService;
    }
}
