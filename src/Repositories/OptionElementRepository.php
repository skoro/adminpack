<?php

namespace Skoro\AdminPack\Repositories;

use Skoro\AdminPack\Models\OptionElement;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Option elements repository.
 */
class OptionElementRepository
{
    /**
     * Gets options group list.
     */
    public function groups(): Collection
    {
        return DB::table('option_elements')
            ->distinct()
            ->select('group')
            ->get()
            ->pluck('group');
    }

    /**
     * Gets elements by group name ordered by priority.
     *
     * @param string $group The group name.
     *
     * @return OptionElement[]
     */
    public function getElementsByGroup(string $group)
    {
        return OptionElement::where('group', $group)
            ->orderBy('priority', 'asc')
            ->get();
    }
}