<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoothsayersUserIdField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('soothsayers', function(Blueprint $table) {
            $table->integer('user_id')->unsigned()->index()->nullable()->default(null)->after('id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('soothsayers', function(Blueprint $table) {
            $table->dropForeign('soothsayers_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
