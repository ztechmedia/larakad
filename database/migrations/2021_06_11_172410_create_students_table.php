<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('students');
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->bigInteger('level_id')->unsigned();
            $table->string('nis', 15);
            $table->string('nisn', 15);
            $table->string('name', 30)->index();
            $table->string('gender', 1);
            $table->string('birth_place', 50);
            $table->date('birth_date');
            $table->string('status', 20);
            $table->string('child_position', 2);
            $table->text('address');
            $table->string('mobile', 15);
            $table->string('school_origin', 100)->nullable();
            $table->string('join_at_class', 3)->nullable();
            $table->date('join_date');
            $table->string('father_name', 30);
            $table->string('mother_name', 30);
            $table->text('parent_address');
            $table->string('parent_mobile', 15);
            $table->string('father_job', 50);
            $table->string('mother_job', 50);
            $table->string('created_by', 30);
            $table->integer('status', 10);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            
            $table->foreign('level_id')->references('id')->on('levels')
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
        Schema::dropIfExists('students');
    }
}
