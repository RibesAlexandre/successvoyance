<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTellingEmailsSendedTable
 * @author Alexandre Ribes
 */
class CreateTellingEmailsSendedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telling_emails_sended', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('topic');
            $table->string('identifier', 20);
            $table->text('content');
            $table->timestamps();
        });

        Schema::table('telling_emails_sended', function(Blueprint $table) {
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
        });

        Schema::create('telling_emails_responses', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('email_send_id')->unsigned()->index();
            $table->integer('soothsayer_id')->unsigned()->index();
            $table->text('content');
            $table->string('identifier', 20);
            $table->timestamps();
        });

        Schema::table('telling_emails_responses', function(Blueprint $table) {
            $table->foreign('email_send_id')->on('telling_emails_sended')->references('id')->onDelete('cascade');
            $table->foreign('soothsayer_id')->on('soothsayers')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('telling_emails_responses', function(Blueprint $table) {
            $table->dropForeign('telling_emails_responses_email_send_id_foreign');
            $table->dropForeign('telling_emails_responses_soothsayer_id_foreign');
        });

        Schema::table('telling_emails_responses', function(Blueprint $table) {
            $table->dropForeign('telling_emails_sended_user_id_foreign');
        });

        Schema::dropIfExists('telling_emails_responses');
        Schema::dropIfExists('telling_emails_sended');
    }
}
