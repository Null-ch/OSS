<?php

namespace App\Infrastructure\Services;

use App\Models\UserDetails;
use Illuminate\Support\Facades\DB;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;
use App\Infrastructure\Interfaces\UserDetailsInterface;
use App\Infrastructure\Validation\UserDetailsVelidator;

class UserDetailsService implements UserDetailsInterface
{
    /**
     * userDetails
     *
     * @var object
     */
    protected $userDetails;

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
     * userDetailsVelidator
     *
     * @var object
     */
    protected $userDetailsVelidator;

    /**
     * __construct
     *
     * @param UserDetails $userDetails
     * @param LogInterface $logger
     * @param MessageService $messageService
     * @param UserDetailsVelidator $userDetailsVelidator
     */
    public function __construct(
        UserDetails $userDetails,
        LogInterface $logger,
        MessageService $messageService,
        UserDetailsVelidator $userDetailsVelidator
    ) {
        $this->userDetails = $userDetails;
        $this->logger = $logger;
        $this->messageService = $messageService;
        $this->userDetailsVelidator = $userDetailsVelidator;
    }

    /**
     * createUserDetails
     *
     * @param  array $data
     * @param  int $userId
     * @return object
     */
    public function createUserDetails(array $data, int $userId): ?object
    {
        $validatedData = $this->userDetailsVelidator->validate($data);
        DB::beginTransaction();
        try {
            $validatedData['user_id'] = $userId;
            $userDetails = $this->userDetails->create($validatedData);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when create userDetails object: ' . $e->getMessage());
            return null;
        }

        return $userDetails;
    }

    /**
     * deleteUserDetails
     *
     * @param  int $id
     * @return string
     */
    public function deleteUserDetails(int $id): ?string
    {
        DB::beginTransaction();
        try {
            $userDetails = $this->userDetails->find($id);
            $userDetails->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when delete userDetails object: ' . $e->getMessage());
            return null;
        }
        return $this->messageService->getMessage('success');
    }
}
