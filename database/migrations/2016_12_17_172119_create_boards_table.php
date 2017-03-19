<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::create('forum_categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('content')->nullable();
            $table->integer('position')->nullable()->default(null);
            $table->softDeletes();
        });

        Schema::create('forum_forums', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('content')->nullable();
            $table->integer('category_id')->unsigned()->index();
            $table->timestamp('message_at');
            $table->integer('position')->nullable()->default(null);
        });

        Schema::table('forum_forums', function(Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('forum_categories');
        });

        Schema::create('roles_forums', function(Blueprint $table) {
            $table->integer('role_id')->unsigned()->index();
            $table->integer('forum_id')->unsigned()->index();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('forum_id')->references('id')->on('forum_forums')->onDelete('cascade');
        });

        Schema::create('forum_forums_track', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('forum_id')->unsigned()->index();
            $table->timestamp('read_at')->nullable()->default(null);
        });

        Schema::table('forum_forums_track', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('forum_id')->references('id')->on('forum_forums')->onDelete('cascade');
        });

        Schema::create('forum_topics', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('forum_id')->unsigned()->index();
            $table->timestamps();
            $table->timestamp('message_at')->nullable()->default(null);
            $table->softDeletes();
            $table->boolean('enabled')->default(true);
        });

        Schema::table('forum_topics', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('forum_id')->references('id')->on('forum_forums')->onDelete('cascade');
        });

        Schema::create('forum_posts', function(Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('topic_id')->unsigned()->index();
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('enabled')->default(true);
        });

        Schema::table('forum_posts', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('topic_id')->references('id')->on('forum_topics')->onDelete('cascade');
        });

        Schema::create('forum_topics_tracks', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('topic_id')->unsigned()->index();
            $table->integer('forum_id')->unsigned()->index();
            $table->timestamp('read_at')->nullable()->default(null);
        });

        Schema::table('forum_topics_tracks', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('topic_id')->references('id')->on('forum_topics')->onDelete('cascade');
            $table->foreign('forum_id')->references('id')->on('forum_forums')->onDelete('cascade');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
