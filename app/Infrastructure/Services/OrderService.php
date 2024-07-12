<?php

namespace App\Services\Admin;

use App\Models\Order;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;
use App\Infrastructure\Services\UserService;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;
use App\Infrastructure\Interfaces\OrderInterface;
use App\Infrastructure\Services\UserDetailsService;
use App\Infrastructure\Services\OrderUserDetailsService;
use App\Infrastructure\Services\UserShippingInformationService;

class OrderService implements OrderInterface
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
     * @var mixed
     */
    protected $userDetailsService;
    /**
     * orderUserDetailsService
     *
     * @var mixed
     */
    protected $orderUserDetailsService;
    /**
     * helpers
     *
     * @var mixed
     */
    protected $helpers;

    /**
     * __construct
     *
     * @param  mixed $order
     * @param  mixed $logger
     * @param  mixed $messageService
     * @param  mixed $userService
     * @param  mixed $userShippingInformationService
     * @param  mixed $userDetailsService
     * @param  mixed $orderUserDetailsService
     * @param  mixed $helpers
     */
    public function __construct(
        Order $order,
        LogInterface $logger,
        MessageService $messageService,
        UserService $userService,
        UserShippingInformationService $userShippingInformationService,
        UserDetailsService $userDetailsService,
        OrderUserDetailsService $orderUserDetailsService,
        Helpers $helpers
    ) {
        $this->order = $order;
        $this->logger = $logger;
        $this->messageService = $messageService;
        $this->userService = $userService;
        $this->userShippingInformationService = $userShippingInformationService;
        $this->userDetailsService = $userDetailsService;
        $this->orderUserDetailsService = $orderUserDetailsService;
        $this->helpers = $helpers;
    }

    /**
     * getOrder
     *
     * @return object
     */
    public function getOrder(int $id): ?object
    {
        try {
            $order = $this->order->find($id);
        } catch (\Exception $e) {
            $this->logger->error('Error when receiving the order: ' . $e->getMessage());
            return null;
        }

        return $order;
    }
    protected function getUserId(array $userData): int
    {
        if (auth()->check()) {
            return auth()->user()->id;
        } else {
            $user = $this->userService->createUser($userData);
            return $user->id;
        }
    }
    /**
     * createOrder
     *
     * @return string
     */
    public function createOrder(array $data): ?string
    {
        DB::beginTransaction();
        try {
            $userId = $this->getUserId($data['user_personal_data']);
            $userShippingInformationId = $this->userShippingInformationService->createUserShippingInformation($data['user_shipping_information'], $userId);
            $userDetailsId = $this->userDetailsService->createUserDetails($data['user_personal_data'], $userId);
            $orderData = $this->helpers::prepareOrderData($data, $userId, $userShippingInformationId->id, $userDetailsId->id);
            $order = $this->order->create($orderData);
            $this->orderUserDetailsService->createOrderUserDetails($order->id, $userDetailsId->id);
            DB::commit();
            return $this->messageService->getMessage('success');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when create new order: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * deleteOrder
     *
     * @return string
     */
    public function deleteOrder(int $id): ?string
    {
        DB::beginTransaction();
        try {
            $order = $this->getOrder($id);
            $order->delete();
            DB::commit();
            return $this->messageService->getMessage('success');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when delete order: ' . $e->getMessage());
            return null;
        }
    }
}
