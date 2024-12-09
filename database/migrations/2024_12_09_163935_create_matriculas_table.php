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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
    		$table->date('fecha');
    		$table->integer('curso');

    		$table->unsignedBigInteger('id_estudiante');
    		$table->unsignedBigInteger('id_modulo');
    		$table->unsignedBigInteger('id_ciclo');
    		$table->foreign('id_estudiante')-> references('id')->on('users')-> onUpdate('cascade')-> onDelete('cascade');
    		$table->foreign('id_modulo')->references('id')->on('modulos')-> onUpdate('cascade')-> onDelete('cascade');
    		$table->foreign('id_ciclo')->references('id')->on('ciclos')-> onUpdate('cascade')-> onDelete('cascade');

            $table->timestamps();
      });


    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
