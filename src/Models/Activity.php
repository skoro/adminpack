<?php

namespace Skoro\AdminPack\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Activity model.
 */
class Activity extends Model
{
    /**
     * The model doesn't need update time.
     */
    const UPDATED_AT = null;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_activities';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'json',
    ];
}
