<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Gate;

/**
 * 
 */
trait HasAuthorization
{
    /**
     * Checks if the user is authorized to perform an action.
     *
     * @param [mixed] $ability The action that is going to be checked.
     * @param [mixed] $user  The user who performs the action.
     * @return boolean True if user is authorized, false otherwise.
     */
    public function isAuthorized($ability, $user)
    {
        $response = Gate::inspect($ability, $user);

        return $response->allowed();
    }
}