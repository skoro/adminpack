<?php

namespace Skoro\AdminPack\Repositories;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use JsonException;

/**
 * Provides a simple gate to the admin_options.
 *
 * In its initial state this repository supports only Eloquent DB.
 * When you need to support different storage engines you must
 * convert this class to interface and create appropriate classes
 * for storages: OptionEloquentRepository, OptionRedisRepository and so on.
 */
class OptionRepository
{
   /**
    * DB table name.
    */
   const TABLE = 'admin_options';

   /**
    * Get the option value.
    *
    * @param string $name    The option name.
    * @param mixed  $default The default value when the option is not found.
    *
    * @return mixed The option value or default if option is not found.
    *
    * @throws JsonException When the option value cannot be decoded from JSON.
    */
   public function get(string $name, $default = null)
   {
      $value = $this->queryBuilder()
         ->where('name', $name)
         ->value('value');
      
      if ($value) {
         return $this->decodeValue($value);
      }

      return $default;
   }

   /**
    * Set the option value or create a new option.
    *
    * @param string|array $name  The option name or a list of option names and values.
    * @param mixed|NULL   $value The value of the single option or NULL when the $name is an array.
    *
    * @return array The list of changed options.
    *
    * @throws JsonException When the option value cannot be encoded into JSON.
    */
   public function set($name, $value = null)
   {
      $names = is_array($name) ? $name : [$name => $value];

      foreach ($names as $k => $v) {
         $this->queryBuilder()
            ->updateOrInsert(
               ['name' => $k],
               ['value' => $this->encodeValue($v)]
            );
      }

      return $names;
   }

   /**
    * Whether the option exist?
    */
   public function exists(string $name): bool
   {
      return $this->queryBuilder()
         ->where('name', $name)
         ->exists();
   }

   /**
    * Delete the option.
    */
   public function delete(string $name): int
   {
      return $this->queryBuilder()
         ->where('name', $name)
         ->delete();
   }

   /**
    * Return a list of the all available options.
    */
   public function all(): Collection
   {
      return $this->queryBuilder()->get();
   }

   /**
    * Option SQL query builder.
    */
   protected function queryBuilder(): Builder
   {
      return DB::table(self::TABLE);
   }

   /**
    * Decode the value into Json.
    *
    * @return mixed
    * @throws JsonException
    */
   protected function decodeValue($value)
   {
      return json_decode($value, true, 512, JSON_THROW_ON_ERROR);
   }

   /**
    * Encode the value from Json.
    *
    * @return string
    * @throws JsonException
    */
   protected function encodeValue($value): string
   {
      return json_encode($value, JSON_THROW_ON_ERROR);
   }
}
