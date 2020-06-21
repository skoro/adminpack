<?php

namespace Skoro\AdminPack\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Option model.
 *
 * @property int           $id
 * @property string        $key
 * @property mixed         $value
 * @property OptionElement $element
 */
class Option extends Model
{
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
        'value' => 'json',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Whether the option is exist?
     */
    public function exists(string $key): bool
    {
        return static::where('key', $key)->exists();
    }

    /**
     * Gets the option value.
     *
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        $option = static::where('key', $key)->first();
        return $option === null ? $default : $option->value;
    }

    /**
     * Sets the option value(s).
     *
     * @param string|array $key
     * @param mixed        $value
     * @return self
     */
    public function set($key, $value = null): self
    {
        $keys = is_array($key) ? $key : [$key => $value];

        foreach ($keys as $key => $value) {
            static::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return $this;
    }

    /**
     * Removes the option.
     */
    public function remove(string $key): bool
    {
        return static::where('key', $key)->delete();
    }

    /**
     * Option element relation.
     */
    public function element(): HasOne
    {
        return $this->hasOne(OptionElement::class);
    }
}
