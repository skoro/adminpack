<?php

namespace Skoro\AdminPack\Services\User;

use Skoro\AdminPack\Dto\UserDto;
use Skoro\AdminPack\Models\User;

/**
 * Update user service.
 */
class UpdateUserService extends UserService
{
    /**
     * Updates user data.
     *
     * @param User    $user The existing user.
     * @param UserDto $dto  The updated data.
     * @return User
     */
    public function update(User $user, UserDto $dto): User
    {
        $user->name = $dto->getName();
        $user->email = $dto->getEmail();
        $user->status = $dto->getStatus();
        $user->role_id = $dto->getRoleId();
        
        if (!empty($dto->getPassword())) {
            $user->password = $this->cryptPassword($dto->getPassword());
        }
        
        $user->saveOrFail();

        return $user;
    }
}