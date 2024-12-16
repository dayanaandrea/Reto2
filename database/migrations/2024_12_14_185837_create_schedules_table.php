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
        Schema::create('shedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_teacher');
            $table->unsignedBigInteger('id_module');
            $table->tinyInteger('day');
            $table->time('hour');
            $table->timestamps();

            $table->foreign('id_teacher')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_module')->references('id')->on('modules')->onUpdate('cascade')->onDelete('cascade');
        });      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
