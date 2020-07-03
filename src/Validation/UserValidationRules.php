<?php

namespace Skoro\AdminPack\Validation;

use Skoro\AdminPack\Models\User;
use Illuminate\Validation\Rule;

/**
 * Contains user validation rules for different cases.
 */
class UserValidationRules
{
    /**
     * The default set of rules.
     */
    protected function default(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255'],
            'password' => ['string', 'min:' . option('user_password_min', 6), 'confirmed'],
        ];
    }

    /**
     * Validation rules for the user creation.
     */
    public function create(): array
    {
        $rules = $this->default();

        /**
         * The email must be globally unique.
         */
        $rules['email'][] = 'unique:admin_users';

        /**
         * Password is required for creating a new user.
         */
        array_unshift($rules['password'], 'required');

        return array_merge(
            $rules,
            $this->getStatusRule(),
            $this->getRoleRule()
        );
    }

    /**
     * Validation rules for updating user.
     */
    public function update(User $user): array
    {
        return array_merge(
            $this->userRules($user),
            $this->getStatusRule(),
            $this->getRoleRule()
        );
    }

    /**
     * Validation rules for updating the user profile.
     */
    public function profile(User $user): array
    {
        return $this->userRules($user);
    }

    /**
     * Minimum set of rules for the existing user.
     */
    protected function userRules(User $user): array
    {
        $rules = $this->default();

        /**
         * Email must be unique but must be skipped the current user.
         */
        $rules['email'][] = Rule::unique('admin_users')->ignore($user);

        /**
         * Password is optional during updating the user.
         */
        array_unshift($rules['password'], 'nullable');

        return $rules;
    }

    /**
     * The rule for the user status.
     */
    protected function getStatusRule(): array
    {
        /**
         * User status is optional.
         */
        return [
            'status' => [
                'nullable',
                Rule::in([
                    User::STATUS_ACTIVE,
                    User::STATUS_DISABLED,
                ]),
            ],
        ];
    }

    /**
     * The rule for the user role.
     */
    protected function getRoleRule(): array
    {
        /**
         * Role is required and must be exist.
         */
        return [
            'role' => [
                'required',
                'int',
                'exists:admin_roles,id',
            ],
        ];
    }
}