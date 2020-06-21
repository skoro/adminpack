<?php

namespace Skoro\AdminPack\Events;

use Skoro\AdminPack\Models\{Role, User};

/**
 * Base class for Role events.
 */
abstract class RoleEvent extends AffectedByUserEvent
{
    private Role $role;

    /**
     * @param User $user Changed by the user.
     * @param Role $role The role.
     */
    public function __construct(User $user, Role $role)
    {
        parent::__construct($user);
        $this->role = $role;
    }

    /**
     * @return Role
     */
    public function role(): Role
    {
        return $this->role;
    }
}