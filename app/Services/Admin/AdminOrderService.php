<?php

namespace App\Services\Admin;

use App\Models\Order;
use App\Helpers\Helpers;
use App\Services\Admin\OrderService;
use App\Infrastructure\Services\UserService;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;
use App\Infrastructure\Services\UserDetailsService;
use App\Infrastructure\Services\UserShippingInformationService;

class AdminOrderService extends OrderService
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
     * userService
     *
     * @var object
     */
    protected $userService;

    /**
     * userShippingInformationService
     *
     * @var object
     */
    protected $userShippingInformationService;

    /**
     * userDetailsService
     *
     * @var object
     */
    protected $userDetailsService;

    /**
     * helpers
     *
     * @var object
     */
    protected $helpers;

    /**
     * __construct
     *
     * @param Order $order
     * @param LogInterface $logger
     * @param MessageService $messageService
     * @param UserService $userService
     * @param UserShippingInformationService $userShippingInformationService
     * @param UserDetailsService $userDetailsService
     * @param Helpers $helpers
     */
    public function __construct(
        Order $order,
        LogInterface $logger,
        MessageService $messageService,
        UserService $userService,
        UserShippingInformationService $userShippingInformationService,
        UserDetailsService $userDetailsService,
        Helpers $helpers
    ) {
        $this->order = $order;
        $this->logger = $logger;
        $this->messageService = $messageService;
        $this->userService = $userService;
        $this->userShippingInformationService = $userShippingInformationService;
        $this->userDetailsService = $userDetailsService;
        $this->helpers = $helpers;
    }
}
