<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('subject_id')->unsigned();
            $table->bigInteger('teacher_id')->unsigned();
            $table->bigInteger('class_id')->unsigned();
            $table->string('day', 10);
            $table->string('start', 10);
            $table->string('end', 10);
            $table->string('year', 10);
            $table->bigInteger('created_by')->unsigned();
            $table->timestamps();

            $table->foreign('subject_id')->references('id')->on('subjects')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('teacher_id')->references('id')->on('teachers')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('class_id')->references('id')->on('classes')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('created_by')->references('id')->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
