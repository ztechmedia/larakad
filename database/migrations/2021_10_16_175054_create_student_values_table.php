<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('class_id')->unsigned();
            $table->string('semester', 10);
            $table->string('year', 15);
            $table->bigInteger('subject_id')->unsigned();
            $table->double('value')->unsigned();
            $table->string('created_by', 30);
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('class_id')->references('id')->on('classes')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('subject_id')->references('id')->on('subjects')
                    ->onUpdate('cascade')
                    ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_values');
    }
}
