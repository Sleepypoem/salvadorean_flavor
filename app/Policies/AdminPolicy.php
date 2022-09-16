<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function store(User $user)
    {
        return $user->hasRole("admin");
    }

    public function createTag(User $user)
    {
    }

    public function editTag(User $user)
    {
    }

    public function destroyTag(User $user)
    {
    }

    public function index(User $user)
    {
        return $user->hasRole("admin");
    }

    public function show(User $user)
    {
        return $user->hasRole("admin");
    }

    public function update(User $user)
    {
        return $user->hasRole("admin");
    }

    public function destroy(User $user)
    {
        return $user->hasRole("admin");
    }

    public function registerAdmin(User $user)
    {
        return $user->hasRole("admin");
    }

    public function updateUserInfo($user, $anotherUser)
    {
        return $user->hasRole("admin") || $user->user_id === $anotherUser->user_id;
    }
}