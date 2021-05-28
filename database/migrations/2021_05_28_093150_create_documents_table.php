<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
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
        Schema::table('documents', function($table)
        {
            $table->dropForeign('proceeding_id');
            $table->dropForeign('user_id');
        });
        Schema::dropIfExists('documents');
    }
}
