<?php

namespace Skoro\AdminPack\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Activity model.
 *
 * @property int    $id
 * @property int    $user_id
 * @property string $event
 * @property string $message
 * @property array  $data
 * @property Carbon $created_at
 * @property User   $user
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

    /**
     * 'user' relation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
