<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vacancies extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Vacancies Table
        Schema::create('vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Drop Table Vacancies
        Schema::drop('vacancies');
    }
}
