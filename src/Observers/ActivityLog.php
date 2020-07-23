<?php

namespace Skoro\AdminPack\Observers;

use Illuminate\Database\Eloquent\Model;
use Skoro\AdminPack\Models\Activity;
use Skoro\AdminPack\Support\ReadableName;

class ActivityLog
{
    const TYPE_NEW = 'new';
    const TYPE_UPDATED = 'updated';
    const TYPE_DELETED = 'deleted';

    /**
     * Handle the Model 'created' event.
     */
    public function created(Model $model)
    {
        $this->createActivityEntry(self::TYPE_NEW, $model);    
    }

    /**
     * Handle the Model 'updated' event.
     */
    public function updated(Model $model)
    {
        $this->createActivityEntry(self::TYPE_UPDATED, $model);
    }

    /**
     * Handle the Model 'deleted' event.
     */
    public function deleted(Model $model)
    {
        $this->createActivityEntry(self::TYPE_DELETED, $model);
    }

    /**
     * Handle the Model 'forceDeleted' event.
     */
    public function forceDeleted(Model $model)
    {
        $this->createActivityEntry(self::TYPE_DELETED, $model);
    }

    protected function createActivityEntry(string $type, Model $model)
    {
        if ($model instanceof ReadableName) {
            $name = $model->getName();
        } else {
            $name = get_class($model);
        }

        $activity = new Activity();
        $activity->user_id = auth()->id();
        $activity->event = $type;
        $activity->message = $name;
        $activity->data = $model->toArray();

        $activity->save();
    }
}