<?php

namespace Skoro\AdminPack\Dto;

use RuntimeException;
use Skoro\AdminPack\Models\User;

/**
 * User Query DTO.
 *
 * This DTO describes user index query.
 */
class UserQueryDto
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getSortField(): string
    {
        return $this->data['sort'] ?? 'id';
    }

    public function getSortOrder(): string
    {
        if (empty($this->data['order'])) {
            return 'desc';
        }

        if ($this->data['order'] == 'asc' || $this->data['order'] == 'desc') {
            return $this->data['order'];
        }

        throw new RuntimeException('Invalid sort order: ' . $this->data['order']);
    }

    public function hasFindValue(): bool
    {
        return (isset($this->data['text'])
            && trim($this->data['text']) != '');
    }

    public function getFindValue(): string
    {
        return $this->data['text'] ?? '';
    }

    public function hasRoleId(): bool
    {
        return isset($this->data['role']);
    }

    public function getRoleId(): int
    {
        return $this->hasRoleId() ? (int) $this->data['role'] : 0;
    }

    public function hasStatus(): bool
    {
        return isset($this->data['status']);
    }

    public function getStatus(): int
    {
        return $this->hasStatus() ? (int) $this->data['status'] : User::STATUS_ACTIVE;
    }
}