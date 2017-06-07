<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->timestamps();
        });

        Schema::create('recruitments_candidacies', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('recruitment_id')->unsigned()->index();
            $table->string('name');
            $table->string('firstname');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('file')->nullable();
            $table->string('siret')->nullable();
            $table->text('content')->nullable();
            $table->timestamp('begin_at')->nullable();
            $table->timestamp('birthday')->nullable();
            $table->timestamps();
        });

        Schema::table('recruitments_candidacies', function(Blueprint $table) {
            $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recruitments_candidacies', function(Blueprint $table) {
            $table->dropForeign('recruitments_candidacies_recruitment_id_foreign');
        });
        Schema::dropIfExists('recruitments');
        Schema::dropIfExists('recruitments_candidacies');
    }
}
