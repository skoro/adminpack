<?php

namespace Skoro\AdminPack\Services;

use Skoro\AdminPack\Events\RoleCreatedEvent;
use Skoro\AdminPack\Events\RoleDeletedEvent;
use Skoro\AdminPack\Events\RoleUpdatedEvent;
use Skoro\AdminPack\Models\Role;
use Skoro\AdminPack\Models\User;
use RuntimeException;

/**
 * Role create/update/delete service.
 */
class RoleService
{
    /**
     * Creates a new role.
     *
     * @param string $name        The role name.
     * @param int[]  $permissions The list of permission IDs.
     * @param User   $createdBy   The user that is created the role.
     */
    public function create(string $name, array $permissions, User $createdBy): Role
    {
        $role = new Role();
        $this->saveRole($role, $name, $permissions);

        event(new RoleCreatedEvent($createdBy, $role));

        return $role;
    }

    /**
     * Updates the role.
     *
     * @param Role   $role        The role to update.
     * @param string $name        The new role name.
     * @param int[]  $permissions The list of permission IDs.
     * @param User   $updatedBy   The user that is updated the role.
     */
    public function update(Role $role, string $name, array $permissions, User $updatedBy): Role
    {
        $this->saveRole($role, $name, $permissions);

        event(new RoleUpdatedEvent($updatedBy, $role));

        return $role;
    }

    /**
     * Deletes the role.
     *
     * @param Role $role       The role to delete.
     * @param User $deletedBy  The user which is deleted the role.
     *
     * @throws RuntimeException When role cannot be deleted because of users.
     */
    public function delete(Role $role, User $deletedBy): bool
    {
        $users = $role->users()->count();
        if ($users > 0) {
            throw new RuntimeException('Role is used by users and cannot be deleted.');
        }

        $status = $role->delete();
        if ($status) {
            event(new RoleDeletedEvent($deletedBy, $role));
        }

        return $status;
    }

    /**
     * Saves the role and sync permissions.
     *
     * @param Role   $role        The role model to save.
     * @param string $name        The new role name.
     * @param int[]  $permissions The list of permission IDs.
     *
     * @throws RuntimeException   When the list of permissions is empty.
     */
    protected function saveRole(Role $role, string $name, array $permissions): void
    {
        if (empty($permissions)) {
            throw new RuntimeException('Permissions list cannot be empty.');
        }

        $role->name = $name;
        $role->saveOrFail();

        $role->permissions()->sync($permissions);
    }
}