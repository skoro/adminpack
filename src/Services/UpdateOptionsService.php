<?php

namespace Skoro\AdminPack\Services;

use Skoro\AdminPack\Facades\Option;

/**
 * Update Options Service.
 */
class UpdateOptionsService
{
    /**
     * Updates options from the key => value list.
     *
     * @param array $values A list of key => value.
     *
     * @return string[] A list of option keys that have been changed.
     */
    public function fromValues(array $values)
    {
        $changed = []; // Option keys.

        foreach ($values as $key => $value) {

            if (Option::exists($key)) {
            
                $origValue = Option::get($key);
            
                if ($value != $origValue) {
                    // TODO: track changes committed by the user !
                    Option::set($key, $value);
                    $changed[] = $key;
                }
            }

        }

        return $changed;
    }
}