<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectionTable extends Migration {

	public function up()
	{
		Schema::create('section', function(Blueprint $table) {
            $table->id();
            $table->string('Name_Section');
            $table->integer('Status');
            $table->bigInteger('Grade_id')->unsigned();
            $table->bigInteger('Class_id')->unsigned();
            $table->timestamps();
       	});
	}

	public function down()
	{
		Schema::drop('section');
	}
}