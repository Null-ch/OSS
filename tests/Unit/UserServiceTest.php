<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Infrastructure\Services\UserService;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Validation\UserValidator;
use App\Infrastructure\Services\MessageService;
use App\Helpers\Helpers;
use Mockery;

class UserServiceTest extends TestCase
{
    protected $userService;
    protected $userMock;
    protected $loggerMock;
    protected $userValidatorMock;
    protected $messageServiceMock;
    protected $helpersMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userMock = Mockery::mock(User::class);
        $this->loggerMock = Mockery::mock(LogInterface::class);
        $this->userValidatorMock = Mockery::mock(UserValidator::class);
        $this->messageServiceMock = Mockery::mock(MessageService::class);
        $this->helpersMock = Mockery::mock(Helpers::class);

        $this->userService = new UserService(
            $this->userMock,
            $this->loggerMock,
            $this->userValidatorMock,
            $this->messageServiceMock,
            $this->helpersMock
        );
    }

    public function testCreateUserSuccess()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ];

        $validatedData = array_merge($data, ['password' => Hash::make(Str::random(8))]);

        $this->userValidatorMock
            ->shouldReceive('validate')
            ->once()
            ->with($data)
            ->andReturn($validatedData);

        $this->userMock
            ->shouldReceive('create')
            ->once()
            ->with($validatedData)
            ->andReturn((object) $validatedData);

        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('commit')->once();

        $user = $this->userService->createUser($data);

        $this->assertNotNull($user);
        $this->assertEquals($validatedData['email'], $user->email);
    }

    public function testCreateUserFailure()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            // другие данные
        ];

        $this->userValidatorMock
            ->shouldReceive('validate')
            ->once()
            ->with($data)
            ->andThrow(new \Exception('Validation error'));

        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('rollBack')->once();

        $this->loggerMock
            ->shouldReceive('error')
            ->once()
            ->with('Error when create user object: Validation error');

        $user = $this->userService->createUser($data);

        $this->assertNull($user);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
