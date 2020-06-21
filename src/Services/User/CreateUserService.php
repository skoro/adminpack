<?php

namespace Skoro\AdminPack\Services\User;

use Skoro\AdminPack\Dto\UserDto;
use Skoro\AdminPack\Models\User;
use RuntimeException;

/**
 * Create user service.
 */
class CreateUserService extends UserService
{
    /**
     * Creates a new user.
     */
    public function create(UserDto $dto): User
    {
        $user = new User();

        $user->name = $dto->getName();
        $user->email = $dto->getEmail();
        $user->status = $dto->getStatus();
        $user->role_id = $dto->getRoleId();

        if (empty($dto->getPassword())) {
            throw new RuntimeException('Cannot create user without password.');
        }
        $user->password = $this->cryptPassword($dto->getPassword());

        $user->saveOrFail();

        return $user;
    }
}