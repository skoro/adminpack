<?php

namespace Skoro\AdminPack\Http\Controllers;

use Skoro\AdminPack\Http\Controllers\AdminController;
use Skoro\AdminPack\Http\Requests\ActivityIndexRequest;
use Skoro\AdminPack\Http\Resources\ActivityResource;
use Skoro\AdminPack\Repositories\ActivityPaginateQuery;

class ActivityController extends AdminController
{
    public function index()
    {
        return view('admin::activities.index');
    }

    public function data(
        ActivityIndexRequest $indexRequest,
        ActivityPaginateQuery $paginateQuery
    ) {
        $dto = $indexRequest->getQueryDto();
        $activities = $paginateQuery->paginate($dto, $indexRequest->getLimit());

        return ActivityResource::collection($activities);
    }
}
