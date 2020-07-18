<?php

namespace Skoro\AdminPack\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Skoro\AdminPack\Dto\UserQueryDto;
use Skoro\AdminPack\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * Paginate users depending on index query.
 */
class UsersPaginateQuery
{
    /**
     * Paginates users.
     *
     * @param UserQueryDto $queryDto The query parameters.
     * @param int          $limit    How many users to query per page.
     */
    public function paginate(UserQueryDto $queryDto, int $limit = 15): LengthAwarePaginator
    {
        $query = User::orderBy($this->mapToSortField($queryDto), $queryDto->getSortOrder());

        if ($queryDto->getSortField() == 'role') {
            $this->withRoles($query);
        }

        if ($queryDto->hasRoleId()) {
            $this->findByRoleId($query, $queryDto->getRoleId());
        }

        if ($queryDto->hasFindValue()) {
            $this->findByNameOrEmail($query, $queryDto);
        }

        if ($queryDto->hasStatus()) {
            $this->findByStatus($query, $queryDto->getStatus());
        }

        $query->limit($limit);

        return $query->paginate();
    }

    /**
     * Adds a conditional to find users by name or email.
     */
    protected function findByNameOrEmail(Builder $mainQuery, UserQueryDto $dto)
    {
        return $mainQuery->where(function (Builder $query) use ($dto) {
            $value = '%' . $dto->getFindValue() . '%';
            $query->where('name', 'like', $value)
                  ->orWhere('email', 'like', $value);
        });
    }

    /**
     * Joins the role table to allow sorting roles.
     */
    protected function withRoles(Builder $query)
    {
        return $query
            ->select('admin_users.*')
            ->join('admin_roles', 'admin_roles.id', '=', 'admin_users.role_id');
    }

    /**
     * Adds a conditional to find users by the role ID.
     */
    protected function findByRoleId(Builder $query, int $roleId)
    {
        return $query->where('role_id', $roleId);
    }

    /**
     * Maps a sort field from the index query to the model's real one.
     */
    protected function mapToSortField(UserQueryDto $dto): string
    {
        switch ($sortField = $dto->getSortField()) {
            case 'created':
                $sortField = 'created_at';

                break;
            case 'role':
                $sortField = 'admin_roles.name';
                break;
        }

        return $sortField;
    }

    /**
     * Adds a conditional to find users by the specified status.
     */
    protected function findByStatus(Builder $query, int $status)
    {
        return $query->where('status', $status);
    }
}