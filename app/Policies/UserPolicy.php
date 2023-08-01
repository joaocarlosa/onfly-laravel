<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $authenticatedUser, User $user)
    {
        return $authenticatedUser->id === $user->id;
    }

    public function delete(User $authenticatedUser, User $user)
    {
        return $authenticatedUser->id === $user->id;
    }

}
