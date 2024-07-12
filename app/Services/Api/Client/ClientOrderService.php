<?php

namespace App\Services\Api\Client;

use App\Models\Order;
use App\Services\Admin\OrderService;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;

class ClientOrderService extends OrderService
{
    /**
     * Model: Order
     *
     * @var object
     */
    protected $order;
    /**
     * LogInterface implementation
     *
     * @var object
     */
    protected $logger;

    /**
     * messageFactory
     *
     * @var object
     */
    protected $messageService;

    /**
     * Construct order service
     *
     * @param Order $order
     * 
     */
    public function __construct(Order $order, LogInterface $logger, MessageService $messageService)
    {
        parent::__construct($order, $logger, $messageService);
    }
}
