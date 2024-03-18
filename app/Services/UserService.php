<?php

namespace App\Services;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Support\Arr;

class UserService implements UserInterface
{
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function getUsers($isTrashedUser)
    {
        $user = User::select("id", "name", "email", "phone_number", "avatar",'deleted_at')->latest();
        if ($isTrashedUser) {
            $user->onlyTrashed();
        }
        return $user->paginate();
    }

    public function createOrUpdate($data, $user = null)
    {
        if (data_get($data, 'profile_pic')) {
            if (!blank($user) && !blank($user->profile_pic) && file_exists($user->profile_pic)){
                $this->fileService->removeFile($user->profile_pic);
                $this->fileService->removeFile($user->avatar);
            }
            $profilePic = $data['profile_pic'];
            $data['profile_pic'] = $this->fileService->uploadProfilePic($profilePic);
            $data['avatar'] = $this->fileService->profilePicAvatar($profilePic);
        }

        if (blank($user)) {
            $user = new User();
        }

        $user->fill(Arr::except($data, ['password']));

        if (!blank($data['password'])) {
            $user->password = $data['password'];
        }

        $user->save();

        return $user->fresh();
    }

    public function show($user)
    {
        $user = $user->load('addresses');
        $user->addressOnly = $user->addresses->pluck('address');
        return $user;
    }

    public function destroy(User $user, $isDeletePermanently = false)
    {
        if ($isDeletePermanently) {
            $this->fileService->removeFile($user->profile_pic);
            $this->fileService->removeFile($user->avatar);
            $user->forceDelete();
        } else {
            $user->delete();
        }
    }

    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();
    }
}
