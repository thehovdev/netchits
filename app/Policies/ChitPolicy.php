<?php

namespace App\Policies;

use App\Chit;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the chit.
     *
     * @param  \App\User  $user
     * @param  \App\Chit  $chit
     * @return mixed
     */
    public function delete(User $user, Chit $chit)
    {
        return $user->id === $chit->user_id;
    }

}
