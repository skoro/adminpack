<?php

namespace Skoro\AdminPack\Support;

/**
 * Can get own name.
 *
 * The class should use this interface when it can return
 * its name in a human readable form (for example, user first
 * and last name).
 */
interface ReadableName
{
    /**
     * Returns the name in a readable name.
     */
    public function getName(): string;
}