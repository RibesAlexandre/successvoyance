<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFortuneTellingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('astrological_signs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->text('content')->nullable();
            $table->date('begin_at');
            $table->date('ending_at');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('horoscopes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('content');
            $table->integer('sign_id')->unsigned()->index()->nullable();
            $table->date('begin_at');
            $table->date('ending_at');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('horoscopes', function(Blueprint $table) {
            $table->foreign('sign_id')->references('id')->on('astrological_signs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('horoscopes', function(Blueprint $table) {
            $table->dropForeign('horoscopes_sign_id_foreign');
        });

        Schema::drop('horoscopes');
        Schema::drop('astrological_signs');
    }
}
