<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->tinyInteger('time');
            //Establecer los valores por defecto que va a tener el enum
            $table->enum('status', ['accepted', 'rejected', 'pending'])->default('pending');


            $table->unsignedBigInteger ('teacher_id');
            $table->unsignedBigInteger ('student_id');
            $table->foreign('teacher_id')-> references('id')-> on('users')-> onUpdate('cascade')-> onDelete('cascade');
            $table->foreign('student_id')-> references('id')-> on('users')-> onUpdate('cascade')-> onDelete('cascade');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
