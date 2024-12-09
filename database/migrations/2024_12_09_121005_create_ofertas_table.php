<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ciclo');
            $table->unsignedBigInteger('id_modulo');
            $table->timestamps();
    
            $table->foreign('id_ciclo')->references('id')->on('ciclos')->onDelete('cascade');
            $table->foreign('id_modulo')->references('id')->on('modulos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ofertas');
    }
};
