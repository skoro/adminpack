<?php

namespace Skoro\AdminPack\Services;

use Skoro\AdminPack\Repositories\OptionRepository;

/**
 * Update Options Service.
 */
class UpdateOptionsService
{
    private OptionRepository $optionRepository;

    public function __construct(OptionRepository $optionRepository)
    {
        $this->optionRepository = $optionRepository;
    }

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

            if ($this->optionRepository->exists($key)) {
            
                $origValue = $this->optionRepository->get($key);
            
                if ($value != $origValue) {
                    // TODO: track changes committed by the user !
                    $this->optionRepository->set($key, $value);
                    $changed[] = $key;
                }
            }

        }

        return $changed;
    }

    public function getOptionRepository(): OptionRepository
    {
        return $this->optionRepository;
    }
}