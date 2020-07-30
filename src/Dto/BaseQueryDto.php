<?php

namespace Skoro\AdminPack\Dto;

use RuntimeException;

/**
 * Base Query DTO.
 *
 * This is a base for queryable DTOs. 
 */
abstract class BaseQueryDto
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Sort field name.
     *
     * @param string $default The default field name when sortable field is missing.
     */
    public function getSortField(string $default = 'id'): string
    {
        return $this->data['sort'] ?? $default;
    }

    /**
     * Sort order.
     *
     * @return string One of 'asc' or 'desc'.
     *
     * @throws RuntimeException When the sort order is not 'asc' or 'desc'.
     */
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
}