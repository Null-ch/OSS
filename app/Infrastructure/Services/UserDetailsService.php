<?php

namespace App\Infrastructure\Services;

use App\Models\UserDetails;
use Illuminate\Support\Facades\DB;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;
use App\Infrastructure\Interfaces\UserDetailsInterface;
use App\Infrastructure\Validation\UserDetailsValidator;
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
    protected $userDetailsValidator;

    /**
     * __construct
     *
     * @param UserDetails $userDetails
     * @param LogInterface $logger
     * @param MessageService $messageService
     * @param UserDetailsValidator $userDetailsValidator
     */
    public function __construct(
        UserDetails $userDetails,
        LogInterface $logger,
        MessageService $messageService,
        UserDetailsValidator $userDetailsValidator
    ) {
        $this->userDetails = $userDetails;
        $this->logger = $logger;
        $this->messageService = $messageService;
        $this->userDetailsValidator = $userDetailsValidator;
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
        $validatedData = $this->userDetailsValidator->validate($data);
        DB::beginTransaction();
        try {
            $validatedData['user_id'] = $userId;
            $userDetails = $this->userDetails::create($validatedData);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error("{$e->getMessage()}" . $e->getTrace());
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
            $this->logger->error("{$e->getMessage()}" . $e->getTrace());
            return null;
        }
        return $this->messageService->getMessage('success');
    }
}
