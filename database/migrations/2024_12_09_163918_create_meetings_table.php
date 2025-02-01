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
            $table->tinyInteger('day');
            $table->tinyInteger('time');
            $table->tinyInteger('week');
            //Establecer los valores por defecto que va a tener el enum
            $table->enum('status', ['aceptada', 'rechazada', 'pendiente', 'confirmada', 'cancelada', 'forzada'])->default('pendiente');
            $table->unsignedBigInteger ('user_id');
            $table->foreign('user_id')-> references('id')-> on('users')-> onUpdate('cascade')-> onDelete('cascade');
            $table->unique(array('user_id', 'id'));
            // Para el otro reto
            $table->string('title', 50)->nullable()->default('Reunión');
            $table->tinyInteger('room')->nullable()->default(0);
            $table->string('subject', 100)->nullable()->default('Solicitud de reunión');
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
