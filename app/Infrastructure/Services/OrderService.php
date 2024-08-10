<?php

namespace App\Infrastructure\Services;

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
     * @var Order
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
     * @var MessageService
     */
    protected $messageService;

    /**
     * userService
     *
     * @var UserService
     */
    protected $userService;

    /**
     * userShippingInformationService
     *
     * @var UserShippingInformationService
     */
    protected $userShippingInformationService;

    /**
     * userDetailsService
     *
     * @var UserDetailsService
     */
    protected $userDetailsService;

    /**
     * helpers
     *
     * @var Helpers
     */
    protected $helpers;

    /**
     * cartService
     *
     * @var CartService
     */
    protected $cartService;

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
     * @param CartService $cartService
     */
    public function __construct(
        Order $order,
        LogInterface $logger,
        MessageService $messageService,
        UserService $userService,
        UserShippingInformationService $userShippingInformationService,
        UserDetailsService $userDetailsService,
        Helpers $helpers,
        CartService $cartService
    ) {
        $this->order = $order;
        $this->logger = $logger;
        $this->messageService = $messageService;
        $this->userService = $userService;
        $this->userShippingInformationService = $userShippingInformationService;
        $this->userDetailsService = $userDetailsService;
        $this->helpers = $helpers;
        $this->cartService = $cartService;
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
            $userShippingInformation = $this->userShippingInformationService->createUserShippingInformation($data['shipping'], $userId);
            $userDetails = $this->userDetailsService->createUserDetails($data['personal_data'], $userId);
            $order->user_shipping_information_id = $userShippingInformation->id;
            $order->user_details_id = $userDetails->id;
            $order->save();
            DB::commit();
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
            $userId = $this->getUserId($data['personal_data']);
            $orderData = $this->helpers->prepareOrderData($data['cart_id'], $userId, $data['delivery_service_id']);
            $order = $this->order->create($orderData);
            $cart = $this->cartService->findCartById($order->cart_id);
            $cart->order_id = $order->id;
            $cart->user_id = $userId;
            $cart->save();
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

    /**
     * getOrder
     *
     * @return object
     */
    public function getUserOrders(int $userId): ?object
    {
        try {
            $orders = $this->order::where('user_id', $userId);
        } catch (\Exception $e) {
            $this->logger->error('Error when get orders: ' . $e->getMessage());
            return null;
        }

        return $orders;
    }
}
