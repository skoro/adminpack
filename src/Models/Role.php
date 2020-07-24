<?php

namespace Skoro\AdminPack\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Skoro\AdminPack\Support\InstanceDescription;

/**
 * Role model.
 *
 * @property int          $id
 * @property string       $name
 * @property Permission[] $permissions
 * @property User[]       $users
 */
class Role extends Model implements InstanceDescription
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_roles';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Permissions relation.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'admin_role_perms');
    }

    /**
     * Users relation.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * The role description.
     */
    public function getDescription(): string
    {
        return 'Role: ' . $this->name;
    }

    /**
     * Synchronizes the Role permissions.
     *
     * @param array $permissions The list of permission IDs.
     */
    public function syncPermissions(array $permissions)
    {
        $changed = $this->permissions()->sync($permissions);

        /**
         * Make the permissions synchronization visible
         * to the ActiveLog.
         *
         * Every changes among role's permissions lead to
         * the 'updated' event that catches up by the Activity observer.
         */
        if (count($changed['attached']) ||
            count($changed['updated'])  ||
            count($changed['detached'])
        ) {
            $this->fireModelEvent('updated', false);
        }
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        /**
         * Always serialize with permissions.
         * Those will be visible in the Activity Log.
         */
        $this->load('permissions');

        return parent::toArray();
    }
}
