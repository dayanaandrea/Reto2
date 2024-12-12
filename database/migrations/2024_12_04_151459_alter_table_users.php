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
            $table->string('lastname');
            $table->string('pin')->unique();
            $table->string('address');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            // La imagen se guarda como string, porque se guardará la ruta
            $table->string('photo')->nullable();

            // Nulable para que cuando se borre un rol se ponga el campo a nulo
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Eliminar las columnas de este migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('lastname');
            $table->dropColumn('pin');
            $table->dropColumn('address');
            $table->dropColumn('phone1');
            $table->dropColumn('phone2');
            $table->dropColumn('photo');

            $table->dropForeign('users_role_id_foreign');
            $table->dropColumn('role_id');
        });
    }
};
