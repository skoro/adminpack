<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminOptionElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_option_elements', function (Blueprint $table) {
            $table->id();
            $table->string('option_name')->unique();
            $table->unsignedBigInteger('perm_id');
            $table->string('label');
            $table->text('description')->nullable();
            $table->string('group');
            $table->string('validators', 512)->default('');
            $table->text('values')->nullable();
            $table->string('widget');
            $table->integer('priority')->default(0);

            $table->foreign('option_name')
                ->references('name')
                ->on('admin_options')
                ->onDelete('RESTRICT');
            $table->foreign('perm_id')
                ->references('id')
                ->on('admin_permissions')
                ->onDelete('RESTRICT');

            $table->index('group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_option_elements');
    }
}
