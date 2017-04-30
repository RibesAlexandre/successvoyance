<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoothsayersFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soothsayers_favorites', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('soothsayer_id')->unsigned()->index();
        });

        Schema::table('soothsayers_favorites', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('soothsayer_id')->references('id')->on('soothsayers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('soothsayers_favorites', function(Blueprint $table) {
            $table->dropForeign('soothsayers_favorites_user_id_foreign');
            $table->dropForeign('soothsayers_favorites_soothsayer_id_foreign');
        });

        Schema::dropIfExists('soothsayers_favorites');
    }
}
