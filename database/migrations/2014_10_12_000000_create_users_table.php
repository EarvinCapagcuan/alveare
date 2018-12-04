<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->date('dob');
            $table->integer('contact');
            $table->string('email');
            $table->unsignedInteger('level_id');
           $table->foreign('level_id')->references('level_id')->on('levels')->onUpdate('cascade')->onDelete('set null');
            $table->unsignedInteger('batch_id');
            $table->foreign('batch_id')->references('id')->on('batches')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedInteger('senior');
            $table->foreign('senior')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
