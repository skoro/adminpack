<?php

namespace Skoro\AdminPack\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Option element model.
 */
class OptionElement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_option_elements';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'values' => 'json',
    ];

    /**
     * Returns the option key.
     */
    public function key(): string
    {
        return $this->option->key;
    }

    /**
     * Gets the option value.
     *
     * @return mixed
     */
    public function value()
    {
        return $this->option->value;
    }

    /**
     * Option relation.
     */
    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class);
    }

    /**
     * Permission relation.
     */
    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'perm_id');
    }
}
