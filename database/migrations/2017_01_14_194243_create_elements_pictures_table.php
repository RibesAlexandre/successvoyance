<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementsPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('astrological_signs_pictures', function(Blueprint $table) {
            $table->engine = 'InnoDb';
            $table->increments('id');
            $table->integer('sign_id')->unsigned()->index();
            $table->integer('picture_id')->unsigned()->index();
            $table->foreign('sign_id')->references('id')->on('astrological_signs')->onDelete('cascade');
            $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('cascade');
        });

        Schema::create('horoscopes_pictures', function(Blueprint $table) {
            $table->engine = 'InnoDb';
            $table->increments('id');
            $table->integer('horoscope_id')->unsigned()->index();
            $table->integer('picture_id')->unsigned()->index();
            $table->foreign('horoscope_id')->references('id')->on('horoscopes')->onDelete('cascade');
            $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('astrological_signs_pictures', function(Blueprint $table) {
            $table->dropForeign('astrological_signs_pictures_sign_id_foreign');
            $table->dropForeign('astrological_signs_pictures_picture_id_foreign');
        });

        Schema::table('horoscopes_pictures', function(Blueprint $table) {
            $table->dropForeign('horoscopes_pictures_horoscope_id_foreign');
            $table->dropForeign('horoscopes_pictures_picture_id_foreign');
        });

        Schema::dropIfExists('astrological_signs_pictures');
        Schema::dropIfExists('horoscopes_pictures');
    }
}
