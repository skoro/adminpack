<?php

namespace Skoro\AdminPack\Support;

/**
 * Instance description.
 *
 * Implement this interface when your class instance or a model
 * wants to describe itself.
 */
interface InstanceDescription
{
    /**
     * Returns the description of a class instance.
     */
    public function getDescription(): string;
}