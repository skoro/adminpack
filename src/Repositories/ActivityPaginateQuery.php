<?php

namespace Skoro\AdminPack\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
}