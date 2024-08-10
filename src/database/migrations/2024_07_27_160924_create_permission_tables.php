<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('model_id');
            $table->string('model_type');
            $table->primary(['role_id','model_id','model_type']);

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

            $table->index(['model_id','model_type']);
        });

        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('model_id');
            $table->string('model_type');
            $table->primary(['permission_id','model_id','model_type']);

            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');

            $table->index(['model_id','model_type']);
        });

        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');
            $table->primary(['permission_id','role_id']);

            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_has_permission');
        Schema::dropIfExists('model_has_permission');
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('permission');
        Schema::dropIfExists('roles');
    }
}
