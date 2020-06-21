<?php

namespace Skoro\AdminPack\Services\User;

use Illuminate\Support\Facades\Hash;

/**
 * Base user service.
 */
abstract class UserService
{
    /**
     * Crypts a password.
     */
    protected function cryptPassword(string $pass): string
    {
        return Hash::make($pass);
    }
}