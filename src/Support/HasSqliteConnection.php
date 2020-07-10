<?php

namespace Skoro\AdminPack\Support;

use Illuminate\Support\Facades\DB;

/**
 * This trait is only checking whether the current connection is SQLite.
 */
trait HasSqliteConnection
{
    public function isSqlite(): bool
    {
        return DB::connection()->getDriverName() == 'sqlite';
    }
}
