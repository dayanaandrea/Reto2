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
    Schema::create('modulos', function (Blueprint $table) {
        $table->id();
        $table->string('codigo', 10)->unique();
        $table->string('nombre', 100);
        $table->tinyInteger('horas');
        $table->tinyInteger('curso');
        $table->unsignedBigInteger('id_ciclo');
        $table->timestamps();

        $table->foreign('id_ciclo')->references('id')->on('ciclos')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulos');
    }
};
