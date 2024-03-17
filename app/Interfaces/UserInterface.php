<?php

namespace App\Interfaces;

use App\Models\User;

interface UserInterface
{
    public function getUsers($isTrashedUser);
    public function createOrUpdate($request, $user = null);
    public function show($user);
    public function destroy(User $user, $isDeletePermanently = false);
    public function restore($id);
}
