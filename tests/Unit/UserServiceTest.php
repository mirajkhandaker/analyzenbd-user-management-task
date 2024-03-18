<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\FileService;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = new UserService(new FileService());
    }

    public function test_list_user()
    {
        User::factory()->count(1)->create();
        $retrievedUsers = $this->userService->getUsers(false);
        $this->assertCount(1, $retrievedUsers);
    }

    public function test_list_deleted_user()
    {
        $users = User::factory()->count(1)->create();
        foreach ($users as $user) {
            $user->delete();
        }

        $retrievedUsers = $this->userService->getUsers(true);
        foreach ($retrievedUsers as $user) {
            $this->assertTrue($user->trashed());
        }
    }

    public function test_create_user()
    {
        $requestData = [
            'name' => 'test user',
            'email' => 'test-user@gmail.com',
            'phone_number' => '01682234164',
            'password' => '123456',
            'profile_pic' => UploadedFile::fake()->image('profile_pic.jpg'),
            'address' => [
                'User address 1',
                'User address 2',
                'User address 3',
            ]
        ];

        $createdUser = $this->userService->createOrUpdate($requestData);

        $this->assertInstanceOf(User::class, $createdUser);

        $this->assertDatabaseHas('users', [
            'name' => $requestData['name'],
            'email' => $requestData['email'],
        ]);
    }

    public function test_update_user()
    {
        $user = User::factory()->create();
        $data = [
            'name' => 'Updated Name',
            'email' => 'updated-email@example.com',
            'phone_number' => '01912067989',
            'password' => '',
            'profile_pic' => UploadedFile::fake()->image('profile_pic.jpg'),
        ];

        $updatedUser = $this->userService->createOrUpdate($data, $user);

        $this->assertEquals($data['name'], $updatedUser->name);
        $this->assertEquals($data['email'], $updatedUser->email);
        $this->assertEquals($data['phone_number'], $updatedUser->phone_number);
    }

    public function test_show_user()
    {
        $user = User::factory()->create();
        $retrievedUsers = $this->userService->show($user);
        $this->assertEquals($user->name, $retrievedUsers->name);
        $this->assertEquals($user->email, $retrievedUsers->email);
        $this->assertEquals($user->phone_number, $retrievedUsers->phone_number);
    }

    public function test_soft_delete_user()
    {
        $user = User::factory()->create();
        $this->userService->destroy($user);
        $this->assertTrue($user->trashed());
    }

    public function test_permanent_delete_user()
    {
        $user = User::factory()->create();
        $this->userService->destroy($user,true);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
    public function test_restore_user()
    {
        $user = User::factory()->create();
        $user->delete();
        $this->userService->restore($user->id);
        $restoredUser = User::find($user->id);
        $this->assertNotSoftDeleted($restoredUser);
    }
}
