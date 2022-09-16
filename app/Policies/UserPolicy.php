<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    public function registerAdmin(User $user)
    {
        return $user->can("create");
    }

    public function destroy(User $user)
    {
        return $user->can("delete");
    }
}
