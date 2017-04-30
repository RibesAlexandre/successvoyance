<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoothsayersConsultationsField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('soothsayers', function(Blueprint $table) {
            $table->integer('total_consultations')->unsigned()->default(0)->after('ratings');
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
            $table->dropColumn('total_consultations');
        });
    }
}
