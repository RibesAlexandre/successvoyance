<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserSoothsayerId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('soothsayers', function(Blueprint $table) {
            $table->dropForeign('soothsayers_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::table('users', function(Blueprint $table) {
            $table->integer('soothsayer_id')->unsigned()->index()->after('email')->nullable()->default(null);
            $table->foreign('soothsayer_id')->references('id')->on('soothsayers')->onDelete('set null');
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
