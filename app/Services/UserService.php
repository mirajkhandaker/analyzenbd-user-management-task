<?php

namespace App\Services;

use App\Interfaces\UserInterface;
use App\Models\User;

class UserService implements UserInterface
{
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function getUsers($isTrashedUser)
    {
        $user = User::select("id", "name", "email", "phone_number", "avatar")->latest();
        if ($isTrashedUser) {
            $user->onlyTrashed();
        }
        return $user->paginate();
    }

    public function createOrUpdate($request, $user = null): User
    {
        if (blank($user)) {
            $user = new User();
        }

        $user->fill($request->except('password'));
        if (!blank($request->get("password"))) $user->password = $request->password;

        if ($request->hasFile('profile_pic')) {
            $user->profile_pic = $this->fileService->uploadProfilePic($request->file('profile_pic'));
            $user->avatar = $this->fileService->profilePicAvatar($request->file('profile_pic'));
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
