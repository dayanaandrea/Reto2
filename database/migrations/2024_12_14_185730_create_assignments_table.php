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
        /*
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_profesor');
            $table->unsignedBigInteger('id_modulo');
            $table->timestamps();

            $table->foreign('id_profesor')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_modulo')->references('id')->on('modulos')->onUpdate('cascade')->onDelete('cascade');
        });
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
