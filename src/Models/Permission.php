<?php

namespace Skoro\AdminPack\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Permission model.
 *
 * @property int    $id
 * @property string $scope
 * @property string $name
 */
class Permission extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Roles relation.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_perms');
    }
}
