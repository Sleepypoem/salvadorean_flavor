<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
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
}