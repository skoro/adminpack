<?php

namespace Skoro\AdminPack\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Role model.
 *
 * @property int          $id
 * @property string       $name
 * @property Permission[] $permissions
 * @property User[]       $users
 */
class Role extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Permissions relation.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_perms');
    }

    /**
     * Users relation.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
