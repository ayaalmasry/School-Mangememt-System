<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('Classrooms', function(Blueprint $table) {
			$table->foreign('Grade_id')->references('id')->on('Grades')
						->onDelete('cascade');
						
		});
		Schema::table('section', function(Blueprint $table) {
			$table->foreign('Grade_id')->references('id')->on('Grades')
						->onDelete('cascade');
						
		});
        Schema::table('section', function(Blueprint $table) {
			$table->foreign('Class_id')->references('id')->on('Classroom')
						->onDelete('cascade');
						
		});
        Schema::table('my__parent12s', function(Blueprint $table) {
            $table->foreign('Nationality_Father_id')->references('id')->on('Nationality');
            $table->foreign('Blood_Type_Father_id')->references('id')->on('Blood');
            $table->foreign('Religion_Father_id')->references('id')->on('Religion');
            $table->foreign('Nationality_Mother_id')->references('id')->on('Nationality');
            $table->foreign('Blood_Type_Mother_id')->references('id')->on('Blood');
            $table->foreign('Religion_Mother_id')->references('id')->on('Religion');
        });
            Schema::table('parent_attachments', function(Blueprint $table) {
			$table->foreign('parent_id')->references('id')->on('my__parent12s')
						->onDelete('cascade');
						
		});

        
        
		
	}

	public function down()
	{
		Schema::table('Classrooms', function(Blueprint $table) {
			$table->dropForeign('Classrooms_Grade_id_foreign');
		});
		Schema::table('section', function(Blueprint $table) {
			$table->dropForeign('section_Grade_id_foreign');
		});
		Schema::table('section', function(Blueprint $table) {
			$table->dropForeign('section_Class_id_foreign');
		});
	}
}