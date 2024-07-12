<?php

namespace App\Services\Admin;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;
use App\Infrastructure\Interfaces\OrderInterface;
use App\Infrastructure\Services\UserService;

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
     * Construct order service
     *
     * @param Order $order
     * 
     */
    public function __construct(Order $order, LogInterface $logger, MessageService $messageService, UserService $userService)
    {
        (object) $this->order = $order;
        (object) $this->logger = $logger;
        (object) $this->messageService = $messageService;
        (object) $this->userService = $userService;
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
    /**
     * createOrder
     *
     * @return string
     */
    public function createOrder(array $data): ?string
    {
        DB::beginTransaction();
        try {
            if (auth()->check()) {
                $userId = auth()->user()->id;
                // $userShippingInformationId = $this->userShippingInformationService->createUser($data['user_shipping_information'], $userId);
                // $userDetailsId = $this->userDetailsService->createUser($data['user_personal_data'], $userId);
            } else {
                $user = $this->userService->createUser($data['user_personal_data']);
                // $userDetailsId = $this->userDetailsService->createUser($data['user_personal_data']);
                // $userShippingInformationId = $this->userShippingInformationService->createUser($data['user_shipping_information']);
            }
            $order = $this->order->create($data);
            // $this->orderUserDetailsService->createorderUserDetails($order->id, $userDetailsId);
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
