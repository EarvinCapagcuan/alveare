<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('address');
            $table->integer('contact');
            $table->string('email');
            $table->date('dob');
            $table->unsignedInteger('batch_id');
            $table->foreign('batch_id')->references('id')->on('batches')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedInteger('instructor_id');
            $table->foreign('instructor_id')->references('id')->on('instructors')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('students');
    }
}
