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
}
