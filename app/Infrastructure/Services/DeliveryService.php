<?php

namespace App\Infrastructure\Services;

use App\Models\Delivery;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Interfaces\DeliveryInterface;

class DeliveryService implements DeliveryInterface
{
    /**
     * Model: Delivery
     *
     * @var object
     */

    protected $delivery;

    /**
     * LogInterface implementation
     *
     * @var object
     */
    protected $logger;

    /**
     * __construct
     *
     * @param Delivery $delivery
     * @param LogInterface $logger
     */
    public function __construct(
        Delivery $delivery,
        LogInterface $logger
    ) {
        $this->delivery = $delivery;
        $this->logger = $logger;
    }

    /**
     * getDelivery
     *
     * @return object|null
     */
    public function getDelivery(int $id): ?object
    {
        try {
            $delivery = $this->delivery::where('deleted_at', null)
                ->findOrFail($id);
        } catch (\Exception $e) {
            $this->logger->error("{$e->getMessage()}" . $e->getTrace());
            return null;
        }

        return $delivery;
    }

    /**
     * getDelivery
     *
     * @return object|null
     */
    public function getAllDeliveries(): ?object
    {
        try {
            $deliveries = $this->delivery::where('deleted_at', null)->get();
            if ($deliveries->isNotEmpty()) {
                return $deliveries;
            }
        } catch (\Exception $e) {
            $this->logger->error("{$e->getMessage()}" . $e->getTrace());
            return null;
        }

        return null;
    }

    /**
     * Getting deliveries paginate
     *
     * @return object
     * 
     */
    public function getDeliveries(int $count): ?object
    {
        try {
            $deliveries = $this->delivery::paginate($count);
        } catch (\Exception $e) {
            $this->logger->error("{$e->getMessage()}" . $e->getTrace());
            return null;
        }

        return $deliveries;
    }
}
