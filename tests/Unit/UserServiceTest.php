<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\FileService;
use App\Services\UserService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;

class UserServiceTest extends TestCase
{
//    use DatabaseTransactions;
    use RefreshDatabase;

    public function test_get_all_users()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@mail.com',
            'phone_number' => '123456',
        ]);

        $fileService = new FileService();
        $userService = new UserService($fileService);
        $users = $userService->getUsers(false);

        $this->assertCount(1, $users);
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
        $fileService = new FileService();
        $userService = new UserService($fileService);
        $createdUser = $userService->createOrUpdate($request);

        $createdUser->dd();

        $this->assertInstanceOf(User::class, $createdUser);

        $this->assertDatabaseHas('users', [
            'name' => $requestData['name'],
            'email' => $requestData['email'],
        ]);
    }
}
