<?php

namespace App\Infrastructure\Services;

use Illuminate\Support\Facades\DB;
use App\Models\UserShippingInformation;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;
use App\Infrastructure\Interfaces\UserShippingInformationInterface;

class UserShippingInformationService implements UserShippingInformationInterface
{
    /**
     * userShippingInformation
     *
     * @param  object $messageService
     */
    protected $userShippingInformation;

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
     * __construct
     *
     * @param UserShippingInformation $userShippingInformation
     * @param LogInterface $logger
     * @param MessageService $messageService
     * 
     */
    public function __construct(
        UserShippingInformation $userShippingInformation,
        LogInterface $logger,
        MessageService $messageService
    ) {
        $this->userShippingInformation = $userShippingInformation;
        $this->logger = $logger;
        $this->messageService = $messageService;
    }

    /**
     * createUserShippingInformation
     *
     * @param  array $shipping
     * @param  int $userId
     * @return object
     */
    public function createUserShippingInformation(array $shipping, int $userId): ?object
    {
        DB::beginTransaction();
        try {
            if (is_null($shipping['id'])) {
                $data = ['user_id' => $userId, 'value' => $shipping['addres']];
            } else {
                $shippingInformation = $this->userShippingInformation::findOrFail($shipping['id']);
                $data = ['user_id' => $userId, 'value' => $shippingInformation->value];
            }
            $userShippingInformation = $this->userShippingInformation::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when create userShippingInformation object: ' . $e->getMessage());
            return null;
        }

        return $userShippingInformation;
    }
  
    /**
     * deleteUserShippingInformation
     *
     * @param  int $id
     * @return string
     */
    public function deleteUserShippingInformation(int $id): ?string
    {
        DB::beginTransaction();
        try {
            $userShippingInformation = $this->userShippingInformation->find($id);
            $userShippingInformation->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when delete userShippingInformation object: ' . $e->getMessage());
            return null;
        }
        return $this->messageService->getMessage('success');
    }
}
