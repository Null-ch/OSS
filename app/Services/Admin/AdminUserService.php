<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendRegistrationEmail;
use Illuminate\Support\Facades\Hash;
use App\Infrastructure\Services\UserService;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\MessageService;
use App\Infrastructure\Validation\UserValidator;

class AdminUserService extends UserService
{
    /**
     * Model: User
     *
     * @var object
     */

    protected $user;
    /**
     * LogInterface implementation
     *
     * @var object
     */

    protected $logger;
    /**
     * userValidator
     *
     * @var object
     */
    protected $userValidator;
    /**
     * messageService
     *
     * @var object
     */
    protected $messageService;

    /**
     * helpers
     *
     * @var mixed
     */
    protected $helpers;

    /**
     * __construct
     *
     * @param User $user
     * @param LogInterface $logger
     * @param UserValidator $userValidator
     * @param MessageService $messageService
     */
    public function __construct(
        User $user,
        LogInterface $logger,
        UserValidator $userValidator,
        MessageService $messageService,
        Helpers $helpers
    ) {
        $this->user = $user;
        $this->logger = $logger;
        $this->userValidator = $userValidator;
        $this->messageService = $messageService;
        $this->helpers = $helpers;
    }

    /**
     * Update current user
     *
     * @param array $data
     * @param int $id
     * 
     */
    public function updateUser(array $data, int $id)
    {
        $user = $this->getUser($id);

        if ($user) {
            try {
                $user->update($data);
            } catch (\Exception $e) {
                $this->logger->error('User update was failed: ' . $e->getMessage());
            }
        } else {
            $this->logger->error('The user with ID ' . $id . ' was not found.');
        }
    }

    /**
     * Delete current user
     *
     * @param int $id
     * 
     */
    public function destroy(int $id)
    {
        try {
            $this->user::destroy($id);
        } catch (\Exception $e) {
            $this->logger->error('Error when deleting a user: ' . $e->getMessage());
        }
    }

    /**
     * Func for chenge activity of user
     *
     * @param int $id
     * @return string
     */
    public function toggleActivity(int $id): ?string
    {
        $user = $this->getUser($id);
        if ($user) {
            $user->is_active == 1 ? $user->is_active = 0 : $user->is_active = 1;
            $user->save();

            return 'Активность изменена';
        } else {
            return null;
        }
    }
}
