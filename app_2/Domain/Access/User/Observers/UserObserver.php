<?php

namespace App\Domain\Access\User\Observers;


use App\Domain\Access\User\Models\User;
use App\Domain\Access\User\Repositories\UserGetUniqueToken;
use App\Domain\Access\User\Repositories\UserGetUniqueUid;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     *
     * @param User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->refresh_token = (new UserGetUniqueToken())->run()->refresh_token;
        $user->uid = (new UserGetUniqueUid())->run();
    }

}
?>
