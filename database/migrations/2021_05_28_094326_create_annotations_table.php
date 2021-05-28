<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annotations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('proceeding_id');
            $table->foreignId('user_id');
            $table->timestamps();

            $table->foreign('proceeding_id')->references('id')->on('proceedings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('annotations', function($table)
        {
            $table->dropForeign('proceeding_id');
            $table->dropForeign('user_id');
        });
        Schema::dropIfExists('annotations');
    }
}
