<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sources extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Sources Table
        Schema::create('sources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->tinyInteger('priority')->index();
            $table->boolean('enabled')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Drop Table Sources
        Schema::drop('sources');
    }
}
