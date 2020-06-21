<?php

namespace Skoro\AdminPack\Policies;

use Skoro\AdminPack\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('user', 'view any');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function view(User $user, User $model): bool
    {
        return ($user->id == $model->id) ||
            ($user->hasPermission('user', 'view'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('user', 'create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function update(User $user, ?User $model): bool
    {
        return ($user->id == $model->id) ||
            $user->hasPermission('user', 'update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function delete(User $user, User $model): bool
    {
        return $user->hasPermission('user', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function restore(User $user, User $model): bool
    {
        return $user->hasPermission('user', 'restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->hasPermission('user', 'force delete');
    }

    /**
     * Determine whether the user can manage roles.
     *
     * @param User $user
     * @return bool
     */
    public function manageRoles(User $user): bool
    {
        return $user->hasPermission('user', 'manage roles');
    }

    /**
     * Determine whether the user can view user actions column in the user list.
     *
     * @param User $user
     * @return bool
     */
    public function viewActions(User $user): bool
    {
        return $user->hasPermission('user', 'view actions');
    }

    /**
     * Determine whether the user can manage system options.
     *
     * @param User $user
     * @return bool
     */
    public function manageOptions(User $user): bool
    {
        return $user->hasPermission('system', 'manage options');
    }
}
