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
        Schema::create('reuniones', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            //Establecer los valores por defecto que va a tener el enum
            $table->enum('estado', ['aceptada', 'rechazada', 'pendiente'])->default('pendiente');


            $table->unsignedBigInteger ('id_profesor');
            $table->unsignedBigInteger ('id_estudiante');
            $table->foreign('id_profesor')-> references('id')-> on('users')-> onUpdate('cascade')-> onDelete('cascade');
            $table->foreign('id_estudiante')-> references('id')-> on('users')-> onUpdate('cascade')-> onDelete('cascade');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reuniones');
    }
};
