<?php

namespace Skoro\AdminPack\Listeners;

use Skoro\AdminPack\Events\{
    RoleCreatedEvent,
    RoleDeletedEvent,
    RoleEvent,
    RoleUpdatedEvent
};
use Skoro\AdminPack\Models\Option as OptionModel;
use Skoro\AdminPack\Models\OptionElement;

/**
 * Synchronizes the option element values for 'user_default_role' option
 * during creating/updating/deleting a role.
 */
class OptionUserDefaultRoleSyncSubscriber
{
    const OPTION_NAME = 'user_default_role';

    /**
     * Updates the role list of the 'user_default_role' option element.
     */
    public function syncRoles(RoleEvent $event): OptionElement
    {
        $element = $this->getOptionElement();

        $roles = roles()->pluck('name', 'id')->toArray();

        $element->values = $roles;
        $element->save();

        return $element;
    }

    /**
     * @throws \RuntimeException When option 'user_default_role' is not found.
     */
    protected function getOptionElement(): OptionElement
    {
        $option = OptionModel::where('key', self::OPTION_NAME)->first();
        if ($option) {
            return $option->element;
        }
        throw new \RuntimeException('Option "' . self::OPTION_NAME . '" not found.');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            RoleCreatedEvent::class,
            'Skoro\AdminPack\Listeners\OptionUserDefaultRoleSyncSubscriber@syncRoles'
        );

        $events->listen(
            RoleUpdatedEvent::class,
            'Skoro\AdminPack\Listeners\OptionUserDefaultRoleSyncSubscriber@syncRoles'
        );

        $events->listen(
            RoleDeletedEvent::class,
            'Skoro\AdminPack\Listeners\OptionUserDefaultRoleSyncSubscriber@syncRoles'
        );
    }
}
