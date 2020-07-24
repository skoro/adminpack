<?php

namespace Skoro\AdminPack\Services;

use Skoro\AdminPack\Models\Role;
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
     */
    public function create(string $name, array $permissions): Role
    {
        return $this->saveRole(new Role(), $name, $permissions);
    }

    /**
     * Updates the role.
     *
     * @param Role   $role        The role to update.
     * @param string $name        The new role name.
     * @param int[]  $permissions The list of permission IDs.
     */
    public function update(Role $role, string $name, array $permissions): Role
    {
        return $this->saveRole($role, $name, $permissions);
    }

    /**
     * Deletes the role.
     *
     * @param Role $role       The role to delete.
     *
     * @throws RuntimeException When role cannot be deleted because of users.
     */
    public function delete(Role $role): bool
    {
        $users = $role->users()->count();
        if ($users > 0) {
            throw new RuntimeException('Role is used by users and cannot be deleted.');
        }

        return $role->delete();
    }

    /**
     * Saves the role and sync permissions.
     *
     * @param Role   $role        The role model to save.
     * @param string $name        The new role name.
     * @param int[]  $permissions The list of permission IDs.
     * 
     * @return Role
     *
     * @throws RuntimeException   When the list of permissions is empty.
     */
    protected function saveRole(Role $role, string $name, array $permissions): Role
    {
        if (empty($permissions)) {
            throw new RuntimeException('Permissions list cannot be empty.');
        }

        $role->name = $name;

        $role->saveOrFail();
        $role->syncPermissions($permissions);

        return $role;
    }
}