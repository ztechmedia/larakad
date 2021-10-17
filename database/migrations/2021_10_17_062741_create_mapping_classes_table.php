<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('mapping_classes');
        Schema::create('mapping_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('class_id')->unsigned();
            $table->string('year', 10);
            $table->string('created_by', 30);
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('class_id')->references('id')->on('classes')
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
        Schema::dropIfExists('mapping_classes');
    }
}
