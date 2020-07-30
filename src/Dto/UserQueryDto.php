<?php

namespace Skoro\AdminPack\Dto;

use Skoro\AdminPack\Models\User;

/**
 * User Query DTO.
 *
 * This DTO describes user index query.
 */
class UserQueryDto extends BaseQueryDto
{
    /**
     * Is a find value included in the query?
     */
    public function hasFindValue(): bool
    {
        return (isset($this->data['text'])
            && trim($this->data['text']) != '');
    }

    /**
     * Returns a find value.
     *
     * @see UserQueryDto::hasFindValue()
     */
    public function getFindValue(): string
    {
        return $this->data['text'] ?? '';
    }

    /**
     * Is a role included in the query ?
     */
    public function hasRoleId(): bool
    {
        return isset($this->data['role']);
    }

    /**
     * Returns a role ID from the query.
     *
     * @see UserQueryDto::hasRoleId()
     */
    public function getRoleId(): int
    {
        return $this->hasRoleId() ? (int) $this->data['role'] : 0;
    }

    /**
     * Is a user status included in the query ?
     */
    public function hasStatus(): bool
    {
        return isset($this->data['status']);
    }

    /**
     * Returns a user status from the query.
     *
     * @see UserQueryDto::hasStatus()
     */
    public function getStatus(): int
    {
        return $this->hasStatus() ? (int) $this->data['status'] : User::STATUS_ACTIVE;
    }
}