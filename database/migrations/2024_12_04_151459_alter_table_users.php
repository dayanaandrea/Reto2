<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Añadir columnas extra para guardar más información sobre los usuarios.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('apellidos');
            $table->string('dni')->unique();
            $table->string('direccion');
            $table->string('tlf1');
            $table->string('tlf2')->nullable();
            $table->string('foto')->nullable();

            $table->unsignedBigInteger('id_rol');
            $table->foreign('id_rol')->references('id')->on('roles')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Eliminar las columnas de este migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('apellidos');
            $table->dropColumn('dni');
            $table->dropColumn('direccion');
            $table->dropColumn('tlf1');
            $table->dropColumn('tlf2');
            $table->dropColumn('foto');

            $table->dropForeign('users_id_rol_foreign');
            $table->dropColumn('id_rol');
        });
    }
};
