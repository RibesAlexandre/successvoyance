<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->string('slug', 60)->unique();
            $table->softDeletes();
        });

        Schema::create('permissions', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->string('slug', 60)->unique();
            $table->text('content')->nullable();
            $table->string('section', 60);
            $table->softDeletes();
        });

        Schema::create('roles_permissions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->index();
            $table->integer('permission_id')->unsigned()->index();
        });

        Schema::table('roles_permissions', function(Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname', 80)->unique();
            $table->string('name', 80);
            $table->string('firstname', 80);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->date('dob')->nullable();
            $table->string('job', 120)->nullable();
            $table->string('website', 120)->nullable();
            $table->string('country', 60)->nullable();
            $table->string('city', 80)->nullable();
            $table->text('biography')->nullable();
            $table->boolean('can_contact')->default(false);
            $table->tinyInteger('can_full_name')->default(0);
            $table->boolean('can_newsletter')->default(true);
            $table->boolean('can_astrological')->default(false);
            $table->boolean('can_age')->default(false);
            $table->datetime('last_connexion')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('roles_users', function(Blueprint $table) {
            $table->integer('user_id')->unsigned()->index();
            $table->integer('role_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('users');
    }
}
