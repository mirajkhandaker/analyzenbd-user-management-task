<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\FileService;
use App\Services\UserService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;

class UserServiceTest extends TestCase
{
//    use DatabaseTransactions;
    use RefreshDatabase;

    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = new UserService(new FileService());
    }
    public function test_create_user()
    {
        $requestData = [
            'name' => 'test user',
            'email' => 'test-user@gmail.com',
            'password' => '123456',
            'profile_pic' => UploadedFile::fake()->image('profile_pic.jpg'),
            'address' => [
                'User address 1',
                'User address 2',
                'User address 3',
            ]
        ];
        $request = new Request([], $requestData);

        $createdUser = $this->userService->createOrUpdate($request);

        $this->assertInstanceOf(User::class, $createdUser);

        $this->assertDatabaseHas('users', [
            'name' => $requestData['name'],
            'email' => $requestData['email'],
        ]);
    }
}
