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
            $this->logger->error('Error when get order: ' . $e->getMessage());
            return null;
        }

        return $order;
    }

    /**
     * getUserId
     *
     * @param  array $userData
     * @return int
     */
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
     * updateOrderWithUserDetails
     *
     * @param  object $order
     * @param  array $data
     * @param  int $userId
     * @return string
     */
    protected function updateOrderWithUserDetails(Order $order, array $data, int $userId): ?string
    {
        DB::beginTransaction();
        try {
            $userShippingInformationId = $this->userShippingInformationService->createUserShippingInformation($data['user_shipping_information'], $userId);
            $userDetailsId = $this->userDetailsService->createUserDetails($data['user_personal_data'], $userId);
            $order->user_shipping_information_id = $userShippingInformationId;
            $order->user_details_id = $userDetailsId;
            $order->save();
            return $this->messageService->getMessage('success');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when update order: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * createOrder
     *
     * @return object
     */
    public function createOrder(array $data): ?object
    {
        DB::beginTransaction();
        try {
            $userId = $this->getUserId($data['user_personal_data']);
            $orderData = $this->helpers->prepareOrderData($data['cart_id'], $userId);
            $order = $this->order->create($orderData);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when create new order: ' . $e->getMessage());
            return null;
        }
        return $order;
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
    
    /**
     * cancelOrder
     *
     * @param  int $id
     * @return string
     */
    public function cancelOrder(int $id): ?string
    {
        DB::beginTransaction();
        try {
            $order = $this->getOrder($id);
            $order->status = 3;
            $order->save();
            DB::commit();
            return $this->messageService->getMessage('success');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when cancel order: ' . $e->getMessage());
            return null;
        }
    }
}
