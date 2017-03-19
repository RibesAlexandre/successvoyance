<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoothsayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soothsayers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 60)->unique();
            $table->string('nickname', 60);
            $table->text('content')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('code', 20)->nullable();
            $table->string('picture')->nullable();
            $table->tinyInteger('ratings')->default(0);
            $table->softDeletes();
        });

        Schema::create('ratings', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('soothsayer_id')->unsigned()->index();
            $table->tinyInteger('stars')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('ratings', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('soothsayer_id')->references('id')->on('soothsayers')->onDelete('cascade');
        });

        Schema::create('comments', function(Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('soothsayer_id')->unsigned()->index()->nullable();
            $table->integer('horoscope_id')->unsigned()->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('comments', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('soothsayer_id')->references('id')->on('soothsayers')->onDelete('cascade');
            $table->foreign('horoscope_id')->references('id')->on('horoscopes')->onDelete('cascade');
        });
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
