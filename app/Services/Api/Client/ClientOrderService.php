<?php

namespace App\Services\Api\Client;

use App\Models\Order;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;
use App\Services\Admin\OrderService;
use App\Infrastructure\Services\UserService;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;
use App\Infrastructure\Services\UserDetailsService;
use App\Infrastructure\Services\UserShippingInformationService;

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
        parent::__construct(
            $order,
            $logger,
            $messageService,
            $userService,
            $userShippingInformationService,
            $userDetailsService,
            $helpers
        );
    }
    public function createOrder(array $data): ?object
    {
        try {
            $order = parent::createOrder($data);
            $updatedOrder = $this->updateOrderWithUserDetails($order, $data, $order->user_id);
            if ($updatedOrder === null) {
                throw new \Exception('Failed to update order with user details');
            }
            return $this->messageService->getMessage('success');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when create new order: ' . $e->getMessage());
            return null;
        }
    }
}
