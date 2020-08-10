<?php

namespace Skoro\AdminPack\Repositories;

use Skoro\AdminPack\Models\Activity;
use Skoro\AdminPack\Models\User;

/**
 * ActivityWriter.
 *
 * Writes an event and its data to the activity log.
 */
class ActivityWriter
{
    /**
     * Commits a log.
     *
     * @param User   $byUser   The event committed by user. For cli scripts can be empty.
     * @param string $event    The event name.
     * @param string $message  The message.
     * @param array  $data     The data.
     */
    public function commit(?User $byUser, string $event, string $message, array $data)
    {
        $activity = new Activity();
        $activity->user_id = $byUser ? $byUser->id : null;
        $activity->event = $event;
        $activity->message = $message;
        $activity->data = $data;

        $activity->save();

        return $activity;
    }
}
