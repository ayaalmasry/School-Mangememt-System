<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quessions', function (Blueprint $table) {
            $table->id();
            $table->string('title',500);
            $table->string('answers',500);
            $table->string('right_answer',500);
            $table->integer('score');
            $table->foreignId('quizze_id')->references('id')->on('quizzs')->onDelete('cascade');
            $table->timestamps();
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quessions');
    }
}
