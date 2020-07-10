<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Skoro\AdminPack\Support\HasSqliteConnection;

class CreateAdminRolesTable extends Migration
{
    use HasSqliteConnection;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('scope');
            $table->string('name');
            $table->unique(['scope', 'name']);
        });

        Schema::create('admin_role_perms', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');
            $table->foreign('role_id')
                  ->references('id')
                  ->on('admin_roles')
                  ->onDelete('CASCADE');
            $table->foreign('permission_id')
                  ->references('id')
                  ->on('admin_permissions')
                  ->onDelete('CASCADE');
        });

        Schema::table('admin_users', function (Blueprint $table) {
            $column = $table->unsignedBigInteger('role_id');
            if ($this->isSqlite()) {
                /**
                 * SQLite requires default column value for ALTER TABLE column.
                 * Also, there is no foreign constrain. This is because 
                 * the foreign statement doesn't do anything and on the rollback
                 * this leads to the exception when we try to drop the foreign.
                 * 
                 * @link https://sqlite.org/lang_altertable.html
                 * @see CreateAdminRolesTable::down()
                 */
                $column->nullable();
            } else {
                $column->after('name');
                $table->foreign('role_id')
                      ->references('id')
                      ->on('admin_roles')
                      ->onDelete('RESTRICT');
          }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            /**
             * See above why we don't use the foreign.
             */
            if (! $this->isSqlite()) {
                $table->dropForeign('admin_users_role_id_foreign');
            }
            $table->dropColumn('role_id');
        });
        Schema::dropIfExists('admin_role_perms');
        Schema::dropIfExists('admin_roles');
        Schema::dropIfExists('admin_permissions');
    }
}
