<?php

namespace Skoro\AdminPack\Observers;

use Illuminate\Database\Eloquent\Model;
use Skoro\AdminPack\Models\Activity;
use Skoro\AdminPack\Repositories\ActivityWriter;
use Skoro\AdminPack\Support\InstanceDescription;

/**
 * Activity Log Observer.
 *
 * Tracks 'created', 'updated', 'deleting' and 'forceDeleted'
 * events from the model and creates an entry in the activity log.
 */
class ActivityLog
{
    /**
     * Activity types.
     */
    const TYPE_NEW = 'new';
    const TYPE_UPDATED = 'updated';
    const TYPE_DELETED = 'deleted';

    protected ActivityWriter $activityWriter;

    public function __construct(ActivityWriter $activityWriter)
    {
        $this->activityWriter = $activityWriter;
    }

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
     * Handle the Model 'deleting' event.
     */
    public function deleting(Model $model)
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

    /**
     * Creates an activity entry.
     *
     * @param string $event The activity event.
     * @param Model  $model The observed model.
     * @return Activity
     */
    protected function createActivityEntry(string $event, Model $model): Activity
    {
        if ($model instanceof InstanceDescription) {
            $message = $model->getDescription();
        } else {
            $message = get_class($model);
        }

        return $this->activityWriter->commit(
            auth()->user(),
            $event,
            $message,
            $model->toArray()
        );
    }
}