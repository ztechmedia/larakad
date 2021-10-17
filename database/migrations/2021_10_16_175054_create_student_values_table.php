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
            $table->bigInteger('map_class_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('subject_id')->unsigned();
            $table->string('created_by', 30);
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
        Schema::dropIfExists('student_values');
    }
}
