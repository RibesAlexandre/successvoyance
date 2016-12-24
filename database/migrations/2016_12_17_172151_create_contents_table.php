<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateContentsTable
 * @author Alexandre Ribes
 */
class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('link');
            $table->integer('position')->nullable()->default(null);
            $table->string('container')->default('header');
        });

        Schema::create('pages', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('content');
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('deletable')->default(true);
        });

        Schema::create('pictures', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('file');
            $table->timestamps();
        });

        Schema::create('pages_pictures', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id')->unsigned()->index();
            $table->integer('picture_id')->unsigned()->index();
        });

        Schema::table('pages_pictures', function(Blueprint $table) {
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('cascade');
        });

        Schema::create('blocks', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('template', 30)->default('default');
            $table->string('link')->nullable()->default(null);
            $table->string('background')->nullable()->default(null);
            $table->text('content')->nullable()->default(null);
            $table->string('day_begin')->nullable()->default(null);
            $table->string('hour_begin')->nullable()->default(null);
            $table->timestamp('begin_at')->nullable()->default(null);
            $table->timestamp('ending_at')->nullable()->default(null);
            $table->string('container')->defaut('content');
            $table->boolean('enabled')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('carousels', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('link')->nullable()->default(null);
            $table->string('content')->nullable()->default(null);
            $table->string('picture')->nullable()->default(null);
            $table->string('begin_at')->nullable()->default(null);
            $table->string('ending_at')->nullable()->default(null);
            $table->boolean('enabled')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages_pictures', function(Blueprint $table) {
            $table->dropForeign('pages_pictures_page_id_foreign');
            $table->dropForeign('pages_pictures_picture_id_foreign');
        });

        Schema::drop('carousels');
        Schema::drop('blocks');
        Schema::drop('pictures');
        Schema::drop('pages_pictures');
        Schema::drop('pages');
        Schema::drop('links');
    }
}
