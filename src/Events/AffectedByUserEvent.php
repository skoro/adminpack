<?php

namespace Skoro\AdminPack\Events;

use Skoro\AdminPack\Models\User;

/**
 * Event that is affected by the user.
 */
abstract class AffectedByUserEvent
{
    private User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function user(): User
    {
        return $this->user;
    }
}