<?php

namespace App\Infrastructure\Services;

use App\Helpers\Helpers;
use App\Models\OrderUserDetail;
use Illuminate\Support\Facades\DB;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;

class OrderUserDetailsService
{
    /**
     * orderUserDetail
     *
     * @var object
     */
    protected $orderUserDetail;
    /**
     * logger
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
     * helpers
     *
     * @var object
     */
    protected $helpers;

    /**
     * __construct
     *
     * @param  object $orderUserDetail
     * @param  object $logger
     * @param  object $messageService
     * @param  mixed $helpers
     */
    public function __construct(
        OrderUserDetail $orderUserDetail,
        LogInterface $logger,
        MessageService $messageService,
        Helpers $helpers
    ) {
        $this->orderUserDetail = $orderUserDetail;
        $this->logger = $logger;
        $this->messageService = $messageService;
        $this->helpers = $helpers;
    }
    public function createOrderUserDetails(int $orderId, int $userDetailsId): ?object
    {
        DB::beginTransaction();
        try {
            $orderUserDetailsData = $this->helpers::prepareOrderUserDetails($orderId, $userDetailsId);
            $orderUserDetail = $this->orderUserDetail->create($orderUserDetailsData);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when create orderUserDetail object: ' . $e->getMessage());
            return null;
        }

        return $orderUserDetail;
    }
    public function deleteOrderUserDetails(int $id): ?string
    {
        DB::beginTransaction();
        try {
            $orderUserDetail = $this->orderUserDetail->find($id);
            $orderUserDetail->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when delete orderUserDetail object: ' . $e->getMessage());
            return null;
        }
        return $this->messageService->getMessage('success');
    }
}
