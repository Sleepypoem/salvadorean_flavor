<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function admin(User $user)
    {
        return $user->hasRole("admin");
    }

    public function userIsSelf(User $user, User $another)
    {
        return $user->user_id == $another->user_id;
    }

    public function userOrAdmin(User $user)
    {
        return $user->hasRole(["admin", "user"]);
    }
}