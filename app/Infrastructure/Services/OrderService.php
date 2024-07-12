<?php

namespace App\Services\Admin;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;
use App\Infrastructure\Interfaces\OrderInterface;

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
     * Construct order service
     *
     * @param Order $order
     * 
     */
    public function __construct(Order $order, LogInterface $logger, MessageService $messageService)
    {
        (object) $this->order = $order;
        (object) $this->logger = $logger;
        (object) $this->messageService = $messageService;
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
            $this->order->create($data);
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
