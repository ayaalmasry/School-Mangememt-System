<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineclassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onlineclasses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Grade_id')->references('id')->on('Grades')->onDelete('cascade');
            $table->foreignId('Classroom_id')->references('id')->on('Classrooms')->onDelete('cascade');
            $table->foreignId('section_id')->references('id')->on('section')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('meeting_id');
            $table->string('topic');
            $table->dateTime('start_at');
            $table->integer('duration')->comment('minutes');
            $table->string('password')->comment('meeting password');
            $table->text('start_url');
            $table->text('join_url');
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
        Schema::dropIfExists('onlineclasses');
    }
}
