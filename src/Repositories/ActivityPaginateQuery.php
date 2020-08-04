<?php

namespace Skoro\AdminPack\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Skoro\AdminPack\Dto\ActivityQueryDto;
use Skoro\AdminPack\Models\Activity;
use Skoro\AdminPack\Models\User;

/**
 * Paginate activities depending on index query.
 */
class ActivityPaginateQuery
{
    /**
     * Paginates activities.
     *
     * @param ActivityQueryDto $queryDto Activity query parameters.
     * @param int              $limit    How much rows to return.
     */
    public function paginate(ActivityQueryDto $queryDto, int $limit = 15): LengthAwarePaginator
    {
        return $this->createGenericQuery($queryDto, $limit)
                    ->paginate();
    }

    /**
     * Paginates activities by a user.
     *
     * @param User             $user     Perform querying activities for the specified user.
     * @param ActivityQueryDto $queryDto Activity query parameters.
     * @param int              $limit    How much rows to return.
     */
    public function paginateByUser(User $user, ActivityQueryDto $queryDto, int $limit = 15): LengthAwarePaginator
    {
        return $this->createGenericQuery($queryDto, $limit)
                    ->where('user_id', $user->id)
                    ->paginate();
    }

    /**
     * Creates a generic pagination query.
     *
     * @param ActivityQueryDto $queryDto Activity query parameters.
     * @param int              $limit    How much rows to return.
     */
    protected function createGenericQuery(ActivityQueryDto $queryDto, int $limit = 15): Builder
    {
        $query = Activity::orderBy(
            $this->mapToSortField($queryDto),
            $queryDto->getSortOrder()
        );

        if ($queryDto->getSortField() == 'user') {
            $this->withUsers($query);
        }

        $query->limit($limit);

        return $query;
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
    protected function withUsers(Builder $query): Builder
    {
        return $query
            ->select('admin_activities.*')
            ->leftJoin('admin_users', 'admin_users.id', '=', 'admin_activities.user_id');
    }
}