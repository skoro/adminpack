<?php

namespace Skoro\AdminPack\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Skoro\AdminPack\Dto\ActivityQueryDto;
use Skoro\AdminPack\Models\Activity;

/**
 * Paginate activities depending on index query.
 */
class ActivityPaginateQuery
{
    /**
     * Paginates activities.
     */
    public function paginate(ActivityQueryDto $queryDto, int $limit = 15): LengthAwarePaginator
    {
        $query = Activity::orderBy(
            $this->mapToSortField($queryDto),
            $queryDto->getSortOrder()
        );

        if ($queryDto->getSortField() == 'user') {
            $this->withUsers($query);
        }

        $query->limit($limit);

        return $query->paginate();
    }

    /**
     * Maps a sort field from the index query to the model's real one.
     */
    protected function mapToSortField(ActivityQueryDto $dto): string
    {
        switch ($sortField = $dto->getSortField()) {
            case 'created':
                $sortField = 'created_at';

                break;
            case 'user':
                $sortField = 'admin_users.name';
                break;
        }

        return $sortField;
    }

    /**
     * Joins the users table to allow sorting by a user.
     */
    protected function withUsers(Builder $query)
    {
        return $query
            ->select('admin_activities.*')
            ->leftJoin('admin_users', 'admin_users.id', '=', 'admin_activities.user_id');
    }
}