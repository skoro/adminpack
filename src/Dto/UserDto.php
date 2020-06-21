<?php

namespace Skoro\AdminPack\Dto;

use Skoro\AdminPack\Models\User;

/**
 * User Data Transfer Object.
 *
 * This DTO is used between the request and the User services.
 */
class UserDto
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getEmail(): string
    {
        return $this->data['email'];
    }

    public function getName(): string
    {
        return $this->data['name'];
    }

    public function getPassword(): string
    {
        return $this->data['password'] ?? '';
    }

    public function getStatus(): int
    {
        return $this->data['status'] ?? User::STATUS_DISABLED;
    }

    public function getRoleId(): int
    {
        return $this->data['role'] ?? 0;
    }
}