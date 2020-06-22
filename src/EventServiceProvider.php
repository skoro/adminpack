<?php

namespace Skoro\AdminPack;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Skoro\AdminPack\Listeners\OptionUserDefaultRoleSyncSubscriber;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        OptionUserDefaultRoleSyncSubscriber::class,
    ];
}
