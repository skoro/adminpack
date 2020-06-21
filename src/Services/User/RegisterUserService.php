<?php

namespace Skoro\AdminPack\Services\User;

use Skoro\AdminPack\Dto\UserDto;
use Skoro\AdminPack\Facades\Option;
use Skoro\AdminPack\Models\User;

/**
 * Register user service.
 */
class RegisterUserService extends UserService
{
    /**
     * Registers a new user.
     */
    public function register(UserDto $dto): User
    {
        $user = new User();

        $user->name = $dto->getName();
        $user->email = $dto->getEmail();
        $user->password = $this->cryptPassword($dto->getPassword());
        $user->status = User::STATUS_ACTIVE;
        $user->role_id = Option::get('user_default_role');

        $user->saveOrFail();

        return $user;
    }
}
