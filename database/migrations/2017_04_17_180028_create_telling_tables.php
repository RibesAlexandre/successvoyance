<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTellingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telling_emails', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('content')->nullable()->default(null);
            $table->integer('amount')->default(0);
            $table->integer('quantity')->default(1);
            $table->boolean('popular')->default(0);
            $table->boolean('enabled')->default(1);
            $table->softDeletes();
        });

        Schema::create('telling_emails_users', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('email_id')->unsigned()->index();
            $table->integer('total')->default(0);
            $table->timestamps();
        });

        Schema::table('telling_emails_users', function(Blueprint $table) {
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('email_id')->on('telling_emails')->references('id')->onDelete('cascade');
        });

        Schema::create('sections_titles', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('title');
            $table->string('content')->nullable();
            $table->string('background')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('telling_emails_users', function(Blueprint $table) {
            $table->dropForeign('telling_emails_users_user_id_foreign');
            $table->dropForeign('telling_emails_users_email_id_foreign');
        });

        Schema::dropIfExists('telling_emails');
        Schema::dropIfexists('telling_emails_users');
    }
}
