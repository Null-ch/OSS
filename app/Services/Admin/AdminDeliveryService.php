<?php

namespace App\Services\Admin;

use App\Models\Delivery;
use Illuminate\Support\Facades\DB;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;
use App\Infrastructure\Services\DeliveryService;

class AdminDeliveryService extends DeliveryService
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
     * messageService
     *
     * @var object
     */
    protected $messageService;

    /**
     * __construct
     *
     * @param Delivery $delivery
     * @param LogInterface $logger
     * @param MessageService $messageService,
     */
    public function __construct(
        Delivery $delivery,
        LogInterface $logger,
        MessageService $messageService
    ) {
        parent::__construct($delivery, $logger);
        $this->messageService = $messageService;
    }

    /**
     * Method createDelivery
     *
     * @param array $data
     *
     * @return Delivery
     */
    public function createDelivery(array $data): ?Delivery
    {
        DB::beginTransaction();
        try {
            $delivery = $this->delivery::create($data);
            DB::commit();
            return $delivery;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when creating a delivery: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Method updateDelivery
     *
     * @param array $data
     * @param int $id
     *
     * @return Delivery
     */
    public function updateDelivery(array $data, int $id): ?Delivery
    {
        $delivery = $this->getDelivery($id);
        DB::beginTransaction();

        if ($delivery) {
            try {
                $delivery->update($data);
                DB::commit();
                return $delivery;
            } catch (\Exception $e) {
                DB::rollBack();
                $this->logger->error('Error updating the delivery: ' . $e->getMessage());
                return null;
            }
        }
    }

    /**
     * Method destroy
     *
     * @param int $id
     *
     * @return string
     */
    public function destroy(int $id): string
    {
        try {
            $this->delivery::destroy($id);
            return $this->messageService->getMessage('success');
        } catch (\Exception $e) {
            $this->logger->error('Error when deleting a delivery: ' . $e->getMessage());
            return $this->messageService->getMessage('failure');
        }
    }

    /**
     * Method toggleActivity
     *
     * @param int $id
     *
     * @return string
     */
    public function toggleActivity(int $id): string
    {
        DB::beginTransaction();
        try {
            $delivery = $this->getDelivery($id);
            if ($delivery) {
                $delivery->is_active == 1 ? $delivery->is_active = 0 : $delivery->is_active = 1;
                $delivery->save();
            }
            DB::commit();
            return $this->messageService->getMessage('success');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error updating the delivery: ' . $e->getMessage());
            return $this->messageService->getMessage('failure');
        }
    }
}
